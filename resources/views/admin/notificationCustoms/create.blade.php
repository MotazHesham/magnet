@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.notificationCustom.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notification-customs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="notification_type_id">{{ trans('cruds.notificationCustom.fields.notification_type') }}</label>
                <select class="form-control select2 {{ $errors->has('notification_type') ? 'is-invalid' : '' }}" name="notification_type_id" id="notification_type_id" required>
                    @foreach($notification_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('notification_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('notification_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notification_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCustom.fields.notification_type_helper') }}</span>
            </div> 
            <div class="form-group">
                <label for="link">{{ trans('cruds.notificationCustom.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
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