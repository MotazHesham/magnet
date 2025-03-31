@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.notificationType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notification-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationType.fields.id') }}
                        </th>
                        <td>
                            {{ $notificationType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationType.fields.user_type') }}
                        </th>
                        <td>
                            {{ $notificationType->user_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationType.fields.type') }}
                        </th>
                        <td>
                            {{ $notificationType->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationType.fields.name') }}
                        </th>
                        <td>
                            {{ $notificationType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationType.fields.default_text') }}
                        </th>
                        <td>
                            {{ $notificationType->default_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationType.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $notificationType->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notification-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection