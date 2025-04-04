@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @include('partials.switchlang')
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.notification-customs.update', [$notificationCustom->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="lang" value="{{ currentEditingLang() }}" id="">
                <div class="form-group">
                    <label for="title">{{ trans('cruds.notificationCustom.fields.title') }} <i class="fas fa-language lang-icon"></i></label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                        name="title" id="title" value="{{ old('title', $notificationCustom->getTranslation('title',currentEditingLang())) }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.notificationCustom.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="description">{{ trans('cruds.notificationCustom.fields.description') }} <i class="fas fa-language lang-icon"></i></label>
                    <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                        name="description" id="description"
                        value="{{ old('description', $notificationCustom->getTranslation('description',currentEditingLang())) }}">
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.notificationCustom.fields.description_helper') }}</span>
                </div> 
                <div class="form-group">
                    <label for="link">{{ trans('cruds.notificationCustom.fields.link') }}</label>
                    <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text"
                        name="link" id="link"
                        value="{{ old('link', $notificationCustom->link) }}">
                    @if ($errors->has('link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.notificationCustom.fields.link_helper') }}</span>
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
