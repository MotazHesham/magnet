<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductStockRememberRequest;
use App\Http\Requests\StoreProductStockRememberRequest;
use App\Http\Requests\UpdateProductStockRememberRequest;
use App\Models\Product;
use App\Models\ProductStockRemember;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductStockRememberController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_stock_remember_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductStockRemember::with(['user', 'product'])->select(sprintf('%s.*', (new ProductStockRemember)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_stock_remember_show';
                $editGate      = 'product_stock_remember_edit';
                $deleteGate    = 'product_stock_remember_delete';
                $crudRoutePart = 'product-stock-remembers';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'product']);

            return $table->make(true);
        }

        return view('admin.productStockRemembers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_stock_remember_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productStockRemembers.create', compact('products', 'users'));
    }

    public function store(StoreProductStockRememberRequest $request)
    {
        $productStockRemember = ProductStockRemember::create($request->all());

        return redirect()->route('admin.product-stock-remembers.index');
    }

    public function edit(ProductStockRemember $productStockRemember)
    {
        abort_if(Gate::denies('product_stock_remember_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productStockRemember->load('user', 'product');

        return view('admin.productStockRemembers.edit', compact('productStockRemember', 'products', 'users'));
    }

    public function update(UpdateProductStockRememberRequest $request, ProductStockRemember $productStockRemember)
    {
        $productStockRemember->update($request->all());

        return redirect()->route('admin.product-stock-remembers.index');
    }

    public function show(ProductStockRemember $productStockRemember)
    {
        abort_if(Gate::denies('product_stock_remember_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productStockRemember->load('user', 'product');

        return view('admin.productStockRemembers.show', compact('productStockRemember'));
    }

    public function destroy(ProductStockRemember $productStockRemember)
    {
        abort_if(Gate::denies('product_stock_remember_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productStockRemember->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductStockRememberRequest $request)
    {
        $productStockRemembers = ProductStockRemember::find(request('ids'));

        foreach ($productStockRemembers as $productStockRemember) {
            $productStockRemember->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
