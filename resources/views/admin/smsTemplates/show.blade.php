@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.smsTemplate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sms-templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.smsTemplate.fields.id') }}
                        </th>
                        <td>
                            {{ $smsTemplate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsTemplate.fields.identifier') }}
                        </th>
                        <td>
                            {{ $smsTemplate->identifier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsTemplate.fields.sms_body') }}
                        </th>
                        <td>
                            {!! $smsTemplate->sms_body !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsTemplate.fields.templateid') }}
                        </th>
                        <td>
                            {{ $smsTemplate->templateid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsTemplate.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $smsTemplate->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sms-templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection