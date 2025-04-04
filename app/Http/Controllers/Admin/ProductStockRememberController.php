<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\ProductStockRemember; 
use Illuminate\Support\Facades\Gate;
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
}
