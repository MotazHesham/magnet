@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.specialOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.special-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $specialOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.order_num') }}
                        </th>
                        <td>
                            {{ $specialOrder->order_num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.user') }}
                        </th>
                        <td>
                            {{ $specialOrder->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.store') }}
                        </th>
                        <td>
                            {{ $specialOrder->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.files') }}
                        </th>
                        <td>
                            @foreach($specialOrder->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.color') }}
                        </th>
                        <td>
                            {{ $specialOrder->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.category') }}
                        </th>
                        <td>
                            {{ $specialOrder->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.variations') }}
                        </th>
                        <td>
                            {{ $specialOrder->variations }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.description') }}
                        </th>
                        <td>
                            {{ $specialOrder->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.delivery_status') }}
                        </th>
                        <td>
                            {{ App\Models\SpecialOrder::DELIVERY_STATUS_SELECT[$specialOrder->delivery_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.offer_price_status') }}
                        </th>
                        <td>
                            {{ App\Models\SpecialOrder::OFFER_PRICE_STATUS_SELECT[$specialOrder->offer_price_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.payment_method') }}
                        </th>
                        <td>
                            {{ App\Models\SpecialOrder::PAYMENT_METHOD_SELECT[$specialOrder->payment_method] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.payment_status') }}
                        </th>
                        <td>
                            {{ App\Models\SpecialOrder::PAYMENT_STATUS_SELECT[$specialOrder->payment_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.payment_data') }}
                        </th>
                        <td>
                            {{ $specialOrder->payment_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.shipping_address') }}
                        </th>
                        <td>
                            {{ $specialOrder->shipping_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.shipping_cost') }}
                        </th>
                        <td>
                            {{ $specialOrder->shipping_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialOrder.fields.total') }}
                        </th>
                        <td>
                            {{ $specialOrder->total }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.special-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection