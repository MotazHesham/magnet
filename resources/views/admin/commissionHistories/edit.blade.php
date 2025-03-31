@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.commissionHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.commission-histories.update", [$commissionHistory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="store_id">{{ trans('cruds.commissionHistory.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id" required>
                    @foreach($stores as $id => $entry)
                        <option value="{{ $id }}" {{ (old('store_id') ? old('store_id') : $commissionHistory->store->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commissionHistory.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order_id">{{ trans('cruds.commissionHistory.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id" required>
                    @foreach($orders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $commissionHistory->order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commissionHistory.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order_detail_id">{{ trans('cruds.commissionHistory.fields.order_detail') }}</label>
                <select class="form-control select2 {{ $errors->has('order_detail') ? 'is-invalid' : '' }}" name="order_detail_id" id="order_detail_id" required>
                    @foreach($order_details as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_detail_id') ? old('order_detail_id') : $commissionHistory->order_detail->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_detail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_detail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commissionHistory.fields.order_detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="admin_commission">{{ trans('cruds.commissionHistory.fields.admin_commission') }}</label>
                <input class="form-control {{ $errors->has('admin_commission') ? 'is-invalid' : '' }}" type="number" name="admin_commission" id="admin_commission" value="{{ old('admin_commission', $commissionHistory->admin_commission) }}" step="0.01" required>
                @if($errors->has('admin_commission'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admin_commission') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commissionHistory.fields.admin_commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="store_earning">{{ trans('cruds.commissionHistory.fields.store_earning') }}</label>
                <input class="form-control {{ $errors->has('store_earning') ? 'is-invalid' : '' }}" type="number" name="store_earning" id="store_earning" value="{{ old('store_earning', $commissionHistory->store_earning) }}" step="0.01" required>
                @if($errors->has('store_earning'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_earning') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commissionHistory.fields.store_earning_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection