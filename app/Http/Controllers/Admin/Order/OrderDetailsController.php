<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyOrderDetailRequest;
use App\Http\Requests\Admin\StoreOrderDetailRequest;
use App\Http\Requests\Admin\UpdateOrderDetailRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Store;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderDetailsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['store', 'order', 'product'],
                'columns' => [
                    'id' => function ($row) {
                        return $row->id ? $row->id : '';
                    },
                    'store_store_name' => function ($row) {
                        return $row->store ? $row->store->store_name : '';
                    },
                    'order_order_num' => function ($row) {
                        return $row->order ? $row->order->order_num : '';
                    },
                    'product_name' => function ($row) {
                        return $row->product ? $row->product->name : '';
                    },
                    'price' => function ($row) {
                        return $row->price ? $row->price : '';
                    },
                    'note' => function ($row) {
                        return $row->note ? $row->note : '';
                    },
                    'variation' => function ($row) {
                        return $row->variation ? $row->variation : '';
                    },
                    'quantity' => function ($row) {
                        return $row->quantity ? $row->quantity : '';
                    },
                    'earn_point' => function ($row) {
                        return $row->earn_point ? $row->earn_point : '';
                    }
                ],
                'gates' => [
                    'view' => 'order_detail_show',
                    'edit' => 'order_detail_edit',
                    'delete' => 'order_detail_delete'
                ],
                'crudRoutePart' => 'order-details'
            ];

            $handler = new DataTableHandler(new OrderDetail(), $config);
            return $handler->handle($request);
        }

        return view('admin.order.orderDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.order.orderDetails.create', compact('orders', 'products', 'stores'));
    }

    public function store(StoreOrderDetailRequest $request)
    {
        $orderDetail = OrderDetail::create($request->all());

        return redirect()->route('admin.order-details.index');
    }

    public function edit(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stores = Store::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderDetail->load('store', 'order', 'product');

        return view('admin.order.orderDetails.edit', compact('orderDetail', 'orders', 'products', 'stores'));
    }

    public function update(UpdateOrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->all());

        return redirect()->route('admin.order-details.index');
    }

    public function show(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderDetail->load('store', 'order', 'product');

        return view('admin.order.orderDetails.show', compact('orderDetail'));
    }

    public function destroy(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderDetailRequest $request)
    {
        $orderDetails = OrderDetail::find(request('ids'));

        foreach ($orderDetails as $orderDetail) {
            $orderDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
