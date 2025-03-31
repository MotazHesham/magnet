@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.commissionHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commission-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $commissionHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.store') }}
                        </th>
                        <td>
                            {{ $commissionHistory->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.order') }}
                        </th>
                        <td>
                            {{ $commissionHistory->order->order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.order_detail') }}
                        </th>
                        <td>
                            {{ $commissionHistory->order_detail->note ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.admin_commission') }}
                        </th>
                        <td>
                            {{ $commissionHistory->admin_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commissionHistory.fields.store_earning') }}
                        </th>
                        <td>
                            {{ $commissionHistory->store_earning }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commission-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection