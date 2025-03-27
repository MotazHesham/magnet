@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.coupon.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coupons.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.coupon.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Coupon::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.coupon.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.coupon.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="discount">{{ trans('cruds.coupon.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', '0') }}" step="0.01" required max="100">
                @if($errors->has('discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.coupon.fields.discount_type') }}</label>
                <select class="form-control {{ $errors->has('discount_type') ? 'is-invalid' : '' }}" name="discount_type" id="discount_type">
                    <option value disabled {{ old('discount_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Coupon::DISCOUNT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('discount_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('discount_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.discount_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.coupon.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.coupon.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stores">{{ trans('cruds.coupon.fields.stores') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('stores') ? 'is-invalid' : '' }}" name="stores[]" id="stores" multiple>
                    @foreach($stores as $id => $store)
                        <option value="{{ $id }}" {{ in_array($id, old('stores', [])) ? 'selected' : '' }}>{{ $store }}</option>
                    @endforeach
                </select>
                @if($errors->has('stores'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stores') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coupon.fields.stores_helper') }}</span>
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