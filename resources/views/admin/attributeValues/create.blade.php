@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.attributeValue.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attribute-values.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="attribute_id">{{ trans('cruds.attributeValue.fields.attribute') }}</label>
                <select class="form-control select2 {{ $errors->has('attribute') ? 'is-invalid' : '' }}" name="attribute_id" id="attribute_id" required>
                    @foreach($attributes as $id => $entry)
                        <option value="{{ $id }}" {{ old('attribute_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('attribute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attributeValue.fields.attribute_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.attributeValue.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', '') }}" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attributeValue.fields.value_helper') }}</span>
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