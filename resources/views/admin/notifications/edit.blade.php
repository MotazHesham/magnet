@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.notification.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notifications.update", [$notification->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.notification.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $notification->type) }}" required>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data">{{ trans('cruds.notification.fields.data') }}</label>
                <textarea class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" name="data" id="data" required>{{ old('data', $notification->data) }}</textarea>
                @if($errors->has('data'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="read_at">{{ trans('cruds.notification.fields.read_at') }}</label>
                <input class="form-control datetime {{ $errors->has('read_at') ? 'is-invalid' : '' }}" type="text" name="read_at" id="read_at" value="{{ old('read_at', $notification->read_at) }}">
                @if($errors->has('read_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('read_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.read_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notification_type_id">{{ trans('cruds.notification.fields.notification_type') }}</label>
                <select class="form-control select2 {{ $errors->has('notification_type') ? 'is-invalid' : '' }}" name="notification_type_id" id="notification_type_id">
                    @foreach($notification_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('notification_type_id') ? old('notification_type_id') : $notification->notification_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('notification_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notification_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.notification_type_helper') }}</span>
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