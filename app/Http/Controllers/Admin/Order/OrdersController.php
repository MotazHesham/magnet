<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyOrderRequest;
use App\Http\Requests\Admin\StoreOrderRequest;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user', 'store'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },
                    'delivery_status' => function ($row) {
                        return $row->delivery_status ? Order::DELIVERY_STATUS_SELECT[$row->delivery_status] : '';
                    },
                    'payment_method' => function ($row) {
                        return $row->payment_method ? Order::PAYMENT_METHOD_SELECT[$row->payment_method] : '';
                    },
                    'payment_status' => function ($row) {
                        return $row->payment_status ? Order::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
                    }, 
                    'shipping_type' => function ($row) {
                        return $row->shipping_type ? Order::SHIPPING_TYPE_SELECT[$row->shipping_type] : '';
                    }, 
                ],
                'gates' => [
                    'view' => 'order_show',
                    'edit' => 'order_edit',
                    'delete' => 'order_delete'
                ],
                'crudRoutePart' => 'orders'
            ];

            $handler = new DataTableHandler(new Order(), $config);
            return $handler->handle($request);
        }

        return view('admin.order.orders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.order.orders.create', compact('stores', 'users'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('user', 'store');

        return view('admin.order.orders.edit', compact('order', 'stores', 'users'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::where('store_id',$order->store_id)->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $order->load('user', 'store', 'orderOrderDetails.product', 'orderCouponUsages');

        return view('admin.order.orders.show', compact('order','products'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        $orders = Order::find(request('ids'));

        foreach ($orders as $order) {
            $order->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
