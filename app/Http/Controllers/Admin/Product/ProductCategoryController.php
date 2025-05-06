<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyProductCategoryRequest;
use App\Http\Requests\Admin\StoreProductCategoryRequest;
use App\Http\Requests\Admin\UpdateProductCategoryRequest;
use App\Models\ProductCategory; 
use App\Utils\DataTableHandler;
use App\Utils\MediaHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    use MediaUploadingTrait;
    public function __construct( 
        protected MediaHandler $mediaHandler
    ) {}

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['parent'],
                'columns' => [ 
                    'name' => function ($row) {
                        return $row->name ? $row->name : '';
                    },
                    'parent_name' => function ($row) {
                        return $row->parent ? $row->parent->name : '';
                    }, 
                    'featured' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => ProductCategory::class
                        ]
                    ],
                    'banner' => [
                        'type' => 'image', 
                    ],
                ],
                'rawColumns' => ['parent'],
                'gates' => [
                    'view' => 'product_category_show',
                    'edit' => 'product_category_edit',
                    'delete' => 'product_category_delete'
                ],
                'crudRoutePart' => 'product-categories'
            ];

            $handler = new DataTableHandler(new ProductCategory(), $config);
            return $handler->handle($request);
        }

        return view('admin.product.productCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.product.productCategories.create', compact('parents'));
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $productCategory = ProductCategory::create($request->all());

        if ($request->input('banner', false)) {
            $this->mediaHandler->handleMediaUpload($productCategory, 'banner', $request->input('banner'));
        }

        return redirect()->route('admin.product-categories.index');
    }

    public function edit(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = ProductCategory::where('id', '!=', $productCategory->id)
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');
        $productCategory->load('parent');

        return view('admin.product.productCategories.edit', compact('parents', 'productCategory'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        if ($request->input('banner', false)) {
            $this->mediaHandler->handleMediaUpload($productCategory, 'banner', $request->input('banner'));
        }

        return redirect()->route('admin.product-categories.index');
    }

    public function show(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->load('parent');

        return view('admin.product.productCategories.show', compact('productCategory'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCategoryRequest $request)
    {
        ProductCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
