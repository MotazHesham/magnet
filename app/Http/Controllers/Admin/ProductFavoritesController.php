<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyProductFavoriteRequest;
use App\Http\Requests\Admin\StoreProductFavoriteRequest;
use App\Http\Requests\Admin\UpdateProductFavoriteRequest;
use App\Models\Product;
use App\Models\ProductFavorite;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductFavoritesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_favorite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductFavorite::with(['product', 'user'])->select(sprintf('%s.*', (new ProductFavorite)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_favorite_show';
                $editGate      = 'product_favorite_edit';
                $deleteGate    = 'product_favorite_delete';
                $crudRoutePart = 'product-favorites';

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
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'user']);

            return $table->make(true);
        }

        return view('admin.productFavorites.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_favorite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productFavorites.create', compact('products', 'users'));
    }

    public function store(StoreProductFavoriteRequest $request)
    {
        $productFavorite = ProductFavorite::create($request->all());

        return redirect()->route('admin.product-favorites.index');
    }

    public function edit(ProductFavorite $productFavorite)
    {
        abort_if(Gate::denies('product_favorite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productFavorite->load('product', 'user');

        return view('admin.productFavorites.edit', compact('productFavorite', 'products', 'users'));
    }

    public function update(UpdateProductFavoriteRequest $request, ProductFavorite $productFavorite)
    {
        $productFavorite->update($request->all());

        return redirect()->route('admin.product-favorites.index');
    }

    public function show(ProductFavorite $productFavorite)
    {
        abort_if(Gate::denies('product_favorite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFavorite->load('product', 'user');

        return view('admin.productFavorites.show', compact('productFavorite'));
    }

    public function destroy(ProductFavorite $productFavorite)
    {
        abort_if(Gate::denies('product_favorite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFavorite->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductFavoriteRequest $request)
    {
        $productFavorites = ProductFavorite::find(request('ids'));

        foreach ($productFavorites as $productFavorite) {
            $productFavorite->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
