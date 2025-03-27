@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.walletTransaction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wallet-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.walletTransaction.fields.id') }}
                        </th>
                        <td>
                            {{ $walletTransaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.walletTransaction.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\WalletTransaction::TYPE_SELECT[$walletTransaction->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.walletTransaction.fields.amount') }}
                        </th>
                        <td>
                            {{ $walletTransaction->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.walletTransaction.fields.payment_status') }}
                        </th>
                        <td>
                            {{ App\Models\WalletTransaction::PAYMENT_STATUS_SELECT[$walletTransaction->payment_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.walletTransaction.fields.payment_data') }}
                        </th>
                        <td>
                            {{ $walletTransaction->payment_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.walletTransaction.fields.payment_method') }}
                        </th>
                        <td>
                            {{ App\Models\WalletTransaction::PAYMENT_METHOD_SELECT[$walletTransaction->payment_method] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wallet-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection