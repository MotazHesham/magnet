@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
       <div class="card-title">
            {{ trans('cruds.smsTemplate.title') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SmsTemplate">
                <thead>
                    <tr>  
                        <th>
                            {{ trans('cruds.smsTemplate.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.smsTemplate.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($smsTemplates as $smsTemplate)
                        <tr>
                            <td>
                                {{ $smsTemplate->name }}
                            </td>
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="updateStatuses(this, 'status', 'App\\Models\\SmsTemplate')" 
                                        value="{{ $smsTemplate->id }}" 
                                        type="checkbox" 
                                        class="c-switch-input" {{ $smsTemplate->status ? 'checked' : '' }}>
                                    <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                @can('sms_template_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sms-templates.edit', $smsTemplate->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 