@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.notificationCustom.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.notification-customs.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.id') }}
                            </th>
                            <td>
                                {{ $notificationCustom->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.notification_type') }}
                            </th>
                            <td>
                                {{ $notificationCustom->notification_type->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.title') }}
                            </th>
                            <td>
                                {{ $notificationCustom->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.description') }}
                            </th>
                            <td>
                                {{ $notificationCustom->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.link') }}
                            </th>
                            <td>
                                {{ $notificationCustom->link }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.notificationCustom.fields.users') }}
                            </th>
                            <td>
                                @foreach($notificationCustom->users as $userNotification)
                                    <span class="badge badge-light">{{ $userNotification->notifiable->name ?? '' }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.notification-customs.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
