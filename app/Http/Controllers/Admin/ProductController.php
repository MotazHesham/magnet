<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['store', 'product_categories', 'brand'])->select(sprintf('%s.*', (new Product)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_show';
                $editGate      = 'product_edit';
                $deleteGate    = 'product_delete';
                $crudRoutePart = 'products';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('store_store_name', function ($row) {
                return $row->store ? $row->store->store_name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('product_categories', function ($row) {
                $labels = [];
                foreach ($row->product_categories as $product_category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $product_category->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('brand_name', function ($row) {
                return $row->brand ? $row->brand->name : '';
            });

            $table->editColumn('featured', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->featured ? 'checked' : null) . '>';
            });
            $table->editColumn('approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->approved ? 'checked' : null) . '>';
            });
            $table->editColumn('published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->published ? 'checked' : null) . '>';
            });
            $table->editColumn('main_photo', function ($row) {
                if ($photo = $row->main_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('current_stock', function ($row) {
                return $row->current_stock ? $row->current_stock : '';
            });
            $table->editColumn('num_of_sale', function ($row) {
                return $row->num_of_sale ? $row->num_of_sale : '';
            });
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store', 'product_categories', 'brand', 'featured', 'approved', 'published', 'main_photo']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_categories = ProductCategory::pluck('name', 'id');

        $brands = Brand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.products.create', compact('brands', 'product_categories', 'stores'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->product_categories()->sync($request->input('product_categories', []));
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

        $product->load('store', 'product_categories', 'brand');

        return view('admin.products.edit', compact('brands', 'product', 'product_categories', 'stores'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->product_categories()->sync($request->input('product_categories', []));
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

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

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
