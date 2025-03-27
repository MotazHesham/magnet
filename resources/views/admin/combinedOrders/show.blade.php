@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.combinedOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.combined-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.combinedOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $combinedOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.combinedOrder.fields.order_num') }}
                        </th>
                        <td>
                            {{ $combinedOrder->order_num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.combinedOrder.fields.total') }}
                        </th>
                        <td>
                            {{ $combinedOrder->total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.combinedOrder.fields.shipping_address') }}
                        </th>
                        <td>
                            {{ $combinedOrder->shipping_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.combinedOrder.fields.user') }}
                        </th>
                        <td>
                            {{ $combinedOrder->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.combined-orders.index') }}">
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
            <a class="nav-link" href="#combined_order_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="combined_order_orders">
            @includeIf('admin.combinedOrders.relationships.combinedOrderOrders', ['orders' => $combinedOrder->combinedOrderOrders])
        </div>
    </div>
</div>

@endsection