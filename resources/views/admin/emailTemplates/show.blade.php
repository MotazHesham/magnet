@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.emailTemplate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.email-templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.id') }}
                        </th>
                        <td>
                            {{ $emailTemplate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.user_type') }}
                        </th>
                        <td>
                            {{ $emailTemplate->user_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.identifier') }}
                        </th>
                        <td>
                            {{ $emailTemplate->identifier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.email_type') }}
                        </th>
                        <td>
                            {{ $emailTemplate->email_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.subject') }}
                        </th>
                        <td>
                            {{ $emailTemplate->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.default_text') }}
                        </th>
                        <td>
                            {!! $emailTemplate->default_text !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $emailTemplate->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.email-templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection