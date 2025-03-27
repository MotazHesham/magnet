@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.orderDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="store_id">{{ trans('cruds.orderDetail.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id">
                    @foreach($stores as $id => $entry)
                        <option value="{{ $id }}" {{ old('store_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_id">{{ trans('cruds.orderDetail.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $entry)
                        <option value="{{ $id }}" {{ old('order_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.orderDetail.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.orderDetail.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.orderDetail.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', '') }}">
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.orderDetail.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="earn_point">{{ trans('cruds.orderDetail.fields.earn_point') }}</label>
                <input class="form-control {{ $errors->has('earn_point') ? 'is-invalid' : '' }}" type="number" name="earn_point" id="earn_point" value="{{ old('earn_point', '') }}" step="1">
                @if($errors->has('earn_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('earn_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.earn_point_helper') }}</span>
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