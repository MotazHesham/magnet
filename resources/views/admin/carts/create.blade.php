@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cart.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.carts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.cart.fields.product') }}</label>
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
                <span class="help-block">{{ trans('cruds.cart.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.cart.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="temp_user_uid">{{ trans('cruds.cart.fields.temp_user_uid') }}</label>
                <input class="form-control {{ $errors->has('temp_user_uid') ? 'is-invalid' : '' }}" type="text" name="temp_user_uid" id="temp_user_uid" value="{{ old('temp_user_uid', '') }}">
                @if($errors->has('temp_user_uid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('temp_user_uid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.temp_user_uid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_id">{{ trans('cruds.cart.fields.store') }}</label>
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
                <span class="help-block">{{ trans('cruds.cart.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.cart.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.cart.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', '') }}">
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="variant">{{ trans('cruds.cart.fields.variant') }}</label>
                <input class="form-control {{ $errors->has('variant') ? 'is-invalid' : '' }}" type="text" name="variant" id="variant" value="{{ old('variant', '') }}">
                @if($errors->has('variant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('variant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.variant_helper') }}</span>
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