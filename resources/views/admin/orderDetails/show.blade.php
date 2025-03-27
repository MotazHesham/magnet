@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $orderDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.store') }}
                        </th>
                        <td>
                            {{ $orderDetail->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.order') }}
                        </th>
                        <td>
                            {{ $orderDetail->order->order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.product') }}
                        </th>
                        <td>
                            {{ $orderDetail->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.price') }}
                        </th>
                        <td>
                            {{ $orderDetail->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.note') }}
                        </th>
                        <td>
                            {{ $orderDetail->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.variant') }}
                        </th>
                        <td>
                            {{ $orderDetail->variant }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.quantity') }}
                        </th>
                        <td>
                            {{ $orderDetail->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.earn_point') }}
                        </th>
                        <td>
                            {{ $orderDetail->earn_point }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection