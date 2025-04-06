<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\CustomerPoint; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CustomerPointsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CustomerPoint::with(['user', 'order', 'order_detail', 'product'])->select(sprintf('%s.*', (new CustomerPoint)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'customer_point_show';
                $editGate      = false;
                $deleteGate    = false;
                $crudRoutePart = 'customer-points';

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

            $table->editColumn('points', function ($row) {
                return $row->points ? $row->points : '';
            });
            $table->addColumn('order_order_num', function ($row) {
                return $row->order ? $row->order->order_num : '';
            });

            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('product_quantity', function ($row) {
                return $row->product_quantity ? $row->product_quantity : '';
            });
            $table->editColumn('refunded', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->refunded ? 'checked' : null) . '>';
            });
            $table->editColumn('converted', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->converted ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'order', 'product', 'refunded', 'converted']);

            return $table->make(true);
        }

        return view('admin.customer.customerPoints.index');
    } 

    public function show(CustomerPoint $customerPoint)
    {
        abort_if(Gate::denies('customer_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerPoint->load('user', 'order', 'order_detail', 'product');

        return view('admin.customer.customerPoints.show', compact('customerPoint'));
    } 
}
