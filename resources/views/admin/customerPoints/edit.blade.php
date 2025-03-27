@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customerPoint.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.customer-points.update", [$customerPoint->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.customerPoint.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $customerPoint->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="points">{{ trans('cruds.customerPoint.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', $customerPoint->points) }}" step="1" required>
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.points_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order_id">{{ trans('cruds.customerPoint.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id" required>
                    @foreach($orders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $customerPoint->order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order_detail_id">{{ trans('cruds.customerPoint.fields.order_detail') }}</label>
                <select class="form-control select2 {{ $errors->has('order_detail') ? 'is-invalid' : '' }}" name="order_detail_id" id="order_detail_id" required>
                    @foreach($order_details as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_detail_id') ? old('order_detail_id') : $customerPoint->order_detail->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_detail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_detail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.order_detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.customerPoint.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $customerPoint->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_quantity">{{ trans('cruds.customerPoint.fields.product_quantity') }}</label>
                <input class="form-control {{ $errors->has('product_quantity') ? 'is-invalid' : '' }}" type="number" name="product_quantity" id="product_quantity" value="{{ old('product_quantity', $customerPoint->product_quantity) }}" step="1" required>
                @if($errors->has('product_quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.product_quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('refunded') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="refunded" value="0">
                    <input class="form-check-input" type="checkbox" name="refunded" id="refunded" value="1" {{ $customerPoint->refunded || old('refunded', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="refunded">{{ trans('cruds.customerPoint.fields.refunded') }}</label>
                </div>
                @if($errors->has('refunded'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refunded') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.refunded_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('converted') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="converted" value="0">
                    <input class="form-check-input" type="checkbox" name="converted" id="converted" value="1" {{ $customerPoint->converted || old('converted', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="converted">{{ trans('cruds.customerPoint.fields.converted') }}</label>
                </div>
                @if($errors->has('converted'))
                    <div class="invalid-feedback">
                        {{ $errors->first('converted') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPoint.fields.converted_helper') }}</span>
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