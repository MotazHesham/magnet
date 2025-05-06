<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyProductRequest;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Services\ProductService;
use App\Services\ProductStockService;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    protected $productService;
    protected $productTaxService;
    protected $productFlashDealService;
    protected $productStockService;
    protected $frequentlyBoughtProductService;

    public function __construct(
        ProductService $productService,
        ProductStockService $productStockService,
    ) {
        $this->productService = $productService;
        $this->productStockService = $productStockService;
    }
    public function attribute_options(Request $request){ 
        $attributes = Attribute::with('attributeAttributeValues')->whereIn('id',$request->selectedAttributes ?? [])->get();
        return view('admin.product.products.attribute-options', compact('attributes'));
    }
    public function attribute_options_edit(Request $request){ 
        $product = Product::find($request->product_id);
        $attributes = Attribute::with('attributeAttributeValues')->whereIn('id',$request->selectedAttributes ?? [])->get();
        return view('admin.product.products.attribute-options-edit', compact('attributes','product'));
    }
    public function sku_combination(Request $request)
    {
        $options = array();

        $colors_active = 0;
        if($request->has('colors')){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        $unit_price = $request->unit_price; 
        $purchase_price = $request->purchase_price; 
        $product_name = $request->name;

        if($request->has('attribute_options')){
            foreach ($request->attribute_options as $key => $no) {
                $name = 'attribute_options_'.$no;  
                $attributeValues = AttributeValue::whereIn('id',$request[$name] ?? [])->get()->pluck('value') ?? [];
                if($attributeValues->isEmpty()){
                    return response()->json(['error' => 'Please select at least one value for attribute '.$no]);
                }
                array_push($options,$attributeValues); 
            }
        }

        $combinations = combinations($options);
        return view('admin.product.products.sku-combinations', compact('combinations', 'purchase_price','unit_price', 'colors_active', 'product_name'));
    }

    public function sku_combination_edit(Request $request)
    {  
        $product = Product::find($request->product_id);
        $product->load('stocks');

        $options = array();
        $colors_active = 0;
        if($request->has('colors')){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price; 
        $purchase_price = $request->purchase_price; 

        if($request->has('attribute_options')){
            foreach ($request->attribute_options as $key => $no) {
                $name = 'attribute_options_'.$no;  
                $attributeValues = AttributeValue::whereIn('id',$request[$name] ?? [])->get()->pluck('value') ?? [];
                if($attributeValues->isEmpty()){
                    return response()->json(['error' => 'Please select at least one value for attribute '.$no]);
                }
                array_push($options,$attributeValues); 
            }
        }

        $combinations = combinations($options);
        return view('admin.product.products.sku-combinations-edit', compact('combinations', 'unit_price', 'purchase_price' , 'colors_active', 'product_name', 'product'));
    }
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['store', 'product_categories', 'brand'],
                'columns' => [ 
                    'name' => function ($row) {
                        return $row->name ? $row->name : '';
                    }, 
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },
                    'brand_name' => function ($row) {
                        return $row->brand ? $row->brand->name : '';
                    }, 
                    'product_categories' => [
                        'type' => 'relation-many',
                        'options' => [
                            'column' => 'name',
                        ]
                    ],
                    'featured' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => Product::class
                        ]
                    ],
                    'approved' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => Product::class
                        ]
                    ],
                    'published' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => Product::class
                        ]
                    ],
                    'main_photo' => [
                        'type' => 'image', 
                    ],
                ],
                'gates' => [
                    'view' => 'product_show',
                    'edit' => 'product_edit',
                    'delete' => 'product_delete'
                ],
                'crudRoutePart' => 'products'
            ];

            $handler = new DataTableHandler(new Product(), $config);
            return $handler->handle($request);     
        }

        return view('admin.product.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_categories = ProductCategory::pluck('name', 'id');

        $brands = Brand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = Color::pluck('name', 'code');

        $attributes = Attribute::pluck('name', 'id');
        
        return view('admin.product.products.create', compact('brands', 'product_categories', 'stores','colors','attributes'));
    }

    public function store(StoreProductRequest $request)
    { 
        $product = $this->productService->store($request->all());

        $request->merge(['product_id' => $product->id]);
        
        $product->product_categories()->sync($request->input('product_categories', []));

        $this->productStockService->store($request->all(), $product);

        if ($request->input('main_photo', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_photo'))))->toMediaCollection('main_photo');
        }

        foreach ($request->input('photos', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_categories = ProductCategory::pluck('name', 'id');

        $brands = Brand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = Color::pluck('name', 'code');

        $attributes = Attribute::pluck('name', 'id');

        $product->load('store', 'product_categories', 'brand');

        return view('admin.product.products.edit', compact('brands', 'product', 'product_categories', 'stores', 'colors' ,'attributes'));
    }

    public function update(UpdateProductRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        $product = $this->productService->update($request->all(),$product);

        $product->product_categories()->sync($request->input('product_categories', []));

        $this->productStockService->store($request->all(), $product);

        if ($request->input('main_photo', false)) {
            if (! $product->main_photo || $request->input('main_photo') !== $product->main_photo->file_name) {
                if ($product->main_photo) {
                    $product->main_photo->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_photo'))))->toMediaCollection('main_photo');
            }
        } elseif ($product->main_photo) {
            $product->main_photo->delete();
        }

        if (count($product->photos) > 0) {
            foreach ($product->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('store', 'product_categories', 'brand', 'productProductReviews', 'productProductComplaints');

        return view('admin.product.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->productService->destroy($product->id);

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        $products = Product::find(request('ids'));

        foreach ($products as $product) {
            $product->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
