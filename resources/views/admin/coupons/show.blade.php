@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coupon.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coupons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.id') }}
                        </th>
                        <td>
                            {{ $coupon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Coupon::TYPE_SELECT[$coupon->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.name') }}
                        </th>
                        <td>
                            {{ $coupon->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.code') }}
                        </th>
                        <td>
                            {{ $coupon->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.discount') }}
                        </th>
                        <td>
                            {{ $coupon->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $coupon->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.discount_type') }}
                        </th>
                        <td>
                            {{ App\Models\Coupon::DISCOUNT_TYPE_SELECT[$coupon->discount_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.start_date') }}
                        </th>
                        <td>
                            {{ $coupon->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.end_date') }}
                        </th>
                        <td>
                            {{ $coupon->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coupon.fields.stores') }}
                        </th>
                        <td>
                            @foreach($coupon->stores as $key => $stores)
                                <span class="label label-info">{{ $stores->store_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coupons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection