@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.smsTemplate.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.sms-templates.update', [$smsTemplate->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>{{ trans('cruds.smsTemplate.fields.name') }}</label>
                    <input class="form-control" type="text"  value="{{ $smsTemplate->name }}" readonly> 
                </div>
                <div class="form-group">
                    <label for="sms_body">{{ trans('cruds.smsTemplate.fields.sms_body') }}</label>
                    <textarea class="form-control {{ $errors->has('sms_body') ? 'is-invalid' : '' }}" name="sms_body" id="sms_body">{!! old('sms_body', $smsTemplate->sms_body) !!}</textarea>
                    @if ($errors->has('sms_body'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sms_body') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.smsTemplate.fields.sms_body_helper') }}</span>
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
