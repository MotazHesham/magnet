@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customerPoint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.id') }}
                        </th>
                        <td>
                            {{ $customerPoint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.user') }}
                        </th>
                        <td>
                            {{ $customerPoint->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.points') }}
                        </th>
                        <td>
                            {{ $customerPoint->points }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.order') }}
                        </th>
                        <td>
                            {{ $customerPoint->order->order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.order_detail') }}
                        </th>
                        <td>
                            {{ $customerPoint->order_detail->price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.product') }}
                        </th>
                        <td>
                            {{ $customerPoint->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.product_quantity') }}
                        </th>
                        <td>
                            {{ $customerPoint->product_quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.refunded') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $customerPoint->refunded ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPoint.fields.converted') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $customerPoint->converted ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection