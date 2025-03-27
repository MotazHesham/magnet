@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.order.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <td>
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.combined_order') }}
                        </th>
                        <td>
                            {{ $order->combined_order->order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.order_num') }}
                        </th>
                        <td>
                            {{ $order->order_num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.user') }}
                        </th>
                        <td>
                            {{ $order->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.store') }}
                        </th>
                        <td>
                            {{ $order->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.store_approval') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $order->store_approval ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.delivery_status') }}
                        </th>
                        <td>
                            {{ App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.payment_method') }}
                        </th>
                        <td>
                            {{ App\Models\Order::PAYMENT_METHOD_SELECT[$order->payment_method] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.payment_status') }}
                        </th>
                        <td>
                            {{ App\Models\Order::PAYMENT_STATUS_SELECT[$order->payment_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.payment_data') }}
                        </th>
                        <td>
                            {{ $order->payment_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.shipping_address') }}
                        </th>
                        <td>
                            {{ $order->shipping_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.shipping_type') }}
                        </th>
                        <td>
                            {{ App\Models\Order::SHIPPING_TYPE_SELECT[$order->shipping_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.coupon_discount') }}
                        </th>
                        <td>
                            {{ $order->coupon_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.total') }}
                        </th>
                        <td>
                            {{ $order->total }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#order_order_details" role="tab" data-toggle="tab">
                {{ trans('cruds.orderDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="order_order_details">
            @includeIf('admin.orders.relationships.orderOrderDetails', ['orderDetails' => $order->orderOrderDetails])
        </div>
    </div>
</div>

@endsection