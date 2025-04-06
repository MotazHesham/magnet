@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        @include('partials.switchlang')
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attributes.update", [$attribute->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="lang" value="{{ currentEditingLang() }}" id="">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.attribute.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $attribute->getTranslation('name',currentEditingLang())) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attribute.fields.name_helper') }}</span>
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