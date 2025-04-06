@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.storeWithdrawRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-withdraw-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $storeWithdrawRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.store') }}
                        </th>
                        <td>
                            {{ $storeWithdrawRequest->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.amount') }}
                        </th>
                        <td>
                            {{ $storeWithdrawRequest->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.note') }}
                        </th>
                        <td>
                            {{ $storeWithdrawRequest->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeWithdrawRequest.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\StoreWithdrawRequest::STATUS_SELECT[$storeWithdrawRequest->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-withdraw-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection