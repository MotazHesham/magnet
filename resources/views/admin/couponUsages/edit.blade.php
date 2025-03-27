@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.couponUsage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coupon-usages.update", [$couponUsage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="coupon_id">{{ trans('cruds.couponUsage.fields.coupon') }}</label>
                <select class="form-control select2 {{ $errors->has('coupon') ? 'is-invalid' : '' }}" name="coupon_id" id="coupon_id">
                    @foreach($coupons as $id => $entry)
                        <option value="{{ $id }}" {{ (old('coupon_id') ? old('coupon_id') : $couponUsage->coupon->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('coupon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponUsage.fields.coupon_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.couponUsage.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $couponUsage->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponUsage.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount">{{ trans('cruds.couponUsage.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $couponUsage->discount) }}" step="0.01">
                @if($errors->has('discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponUsage.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="combined_order_id">{{ trans('cruds.couponUsage.fields.combined_order') }}</label>
                <select class="form-control select2 {{ $errors->has('combined_order') ? 'is-invalid' : '' }}" name="combined_order_id" id="combined_order_id">
                    @foreach($combined_orders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('combined_order_id') ? old('combined_order_id') : $couponUsage->combined_order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('combined_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('combined_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponUsage.fields.combined_order_helper') }}</span>
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