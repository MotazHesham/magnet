@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.refundRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.refund-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $refundRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.user') }}
                        </th>
                        <td>
                            {{ $refundRequest->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.special_order') }}
                        </th>
                        <td>
                            {{ $refundRequest->special_order->order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.order') }}
                        </th>
                        <td>
                            {{ $refundRequest->order->order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.order_detail') }}
                        </th>
                        <td>
                            {{ $refundRequest->order_detail->variant ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.store') }}
                        </th>
                        <td>
                            {{ $refundRequest->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.reason') }}
                        </th>
                        <td>
                            {{ $refundRequest->reason }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.refund_amount') }}
                        </th>
                        <td>
                            {{ $refundRequest->refund_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.store_approval') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $refundRequest->store_approval ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.admin_approval') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $refundRequest->admin_approval ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.reject_reason') }}
                        </th>
                        <td>
                            {{ $refundRequest->reject_reason }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.invoice_photo') }}
                        </th>
                        <td>
                            @if($refundRequest->invoice_photo)
                                <a href="{{ $refundRequest->invoice_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $refundRequest->invoice_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.product_photo') }}
                        </th>
                        <td>
                            @if($refundRequest->product_photo)
                                <a href="{{ $refundRequest->product_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $refundRequest->product_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refundRequest.fields.refund_status') }}
                        </th>
                        <td>
                            {{ App\Models\RefundRequest::REFUND_STATUS_SELECT[$refundRequest->refund_status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.refund-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection