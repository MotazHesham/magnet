@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.notificationType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notification-types.update", [$notificationType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_type">{{ trans('cruds.notificationType.fields.user_type') }}</label>
                <input class="form-control {{ $errors->has('user_type') ? 'is-invalid' : '' }}" type="text" name="user_type" id="user_type" value="{{ old('user_type', $notificationType->user_type) }}" required>
                @if($errors->has('user_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationType.fields.user_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.notificationType.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $notificationType->type) }}" required>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationType.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.notificationType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $notificationType->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="default_text">{{ trans('cruds.notificationType.fields.default_text') }}</label>
                <textarea class="form-control {{ $errors->has('default_text') ? 'is-invalid' : '' }}" name="default_text" id="default_text" required>{{ old('default_text', $notificationType->default_text) }}</textarea>
                @if($errors->has('default_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationType.fields.default_text_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $notificationType->status || old('status', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="status">{{ trans('cruds.notificationType.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationType.fields.status_helper') }}</span>
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