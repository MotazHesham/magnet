<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCustomerPointRequest;
use App\Http\Requests\StoreCustomerPointRequest;
use App\Http\Requests\UpdateCustomerPointRequest;
use App\Models\CustomerPoint;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Gate;
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
                $editGate      = 'customer_point_edit';
                $deleteGate    = 'customer_point_delete';
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

        return view('admin.customerPoints.index');
    }

    public function create()
    {
        abort_if(Gate::denies('customer_point_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_details = OrderDetail::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customerPoints.create', compact('order_details', 'orders', 'products', 'users'));
    }

    public function store(StoreCustomerPointRequest $request)
    {
        $customerPoint = CustomerPoint::create($request->all());

        return redirect()->route('admin.customer-points.index');
    }

    public function edit(CustomerPoint $customerPoint)
    {
        abort_if(Gate::denies('customer_point_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_details = OrderDetail::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customerPoint->load('user', 'order', 'order_detail', 'product');

        return view('admin.customerPoints.edit', compact('customerPoint', 'order_details', 'orders', 'products', 'users'));
    }

    public function update(UpdateCustomerPointRequest $request, CustomerPoint $customerPoint)
    {
        $customerPoint->update($request->all());

        return redirect()->route('admin.customer-points.index');
    }

    public function show(CustomerPoint $customerPoint)
    {
        abort_if(Gate::denies('customer_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerPoint->load('user', 'order', 'order_detail', 'product');

        return view('admin.customerPoints.show', compact('customerPoint'));
    }

    public function destroy(CustomerPoint $customerPoint)
    {
        abort_if(Gate::denies('customer_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerPoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomerPointRequest $request)
    {
        $customerPoints = CustomerPoint::find(request('ids'));

        foreach ($customerPoints as $customerPoint) {
            $customerPoint->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
