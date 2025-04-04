@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        @include('partials.switchlang')
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notification-types.update", [$notificationType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf 
            <input type="hidden" name="lang" value="{{ currentEditingLang() }}" id="">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.notificationType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $notificationType->getTranslation('name',currentEditingLang())) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="default_text">{{ trans('cruds.notificationType.fields.default_text') }}</label>
                <textarea class="form-control {{ $errors->has('default_text') ? 'is-invalid' : '' }}" name="default_text" id="default_text" required>{{ old('default_text', $notificationType->getTranslation('default_text',currentEditingLang())) }}</textarea>
                @if($errors->has('default_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationType.fields.default_text_helper') }}</span>
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