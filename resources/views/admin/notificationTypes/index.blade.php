@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.notificationType.title') }}
                    <div class="mt-4">
                        <a href="{{ route('admin.notification-types.index',['user_type' => 'customer']) }}" 
                            class="btn mr-2 @if(request('user_type','customer') == 'customer') btn-info  @else btn-default @endif">
                            {{ trans('options.user_type.customer') }}
                        </a>
                        <a href="{{ route('admin.notification-types.index',['user_type' => 'seller']) }}" 
                            class="btn mr-2 @if(request('user_type','customer') == 'seller') btn-info  @else btn-default @endif">
                            {{ trans('options.user_type.seller') }}
                        </a>
                        <a href="{{ route('admin.notification-types.index',['user_type' => 'staff']) }}" 
                            class="btn mr-2 @if(request('user_type','customer') == 'staff') btn-info  @else btn-default @endif">
                            {{ trans('options.user_type.staff') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table
                        class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-NotificationType">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.notificationType.fields.id') }}
                                </th> 
                                <th>
                                    {{ trans('cruds.notificationType.fields.name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.notificationType.fields.default_text') }}
                                </th>
                                <th>
                                    {{ trans('cruds.notificationType.fields.status') }}
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notificationTypes as $notificationType)
                                <tr>
                                    <td>
                                        @if($notificationType->type == 'custom')
                                        {{ $notificationType->id }}
                                        @else
                                        <i class="fas fa-lock"></i>
                                        @endif
                                    </td> 
                                    <td>{{ $notificationType->name }}</td>
                                    <td>{{ $notificationType->default_text }}</td>
                                    <td>
                                        <label class="c-switch c-switch-pill c-switch-success">
                                            <input onchange="updateStatuses(this, 'status', 'App\\Models\\NotificationType')" 
                                                value="{{ $notificationType->id }}" 
                                                type="checkbox" 
                                                class="c-switch-input" {{ $notificationType->status ? 'checked' : '' }}>
                                            <span class="c-switch-slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        @can('notification_type_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.notification-types.edit', $notificationType->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan
                                        @can('notification_type_delete')
                                            @if($notificationType->type == 'custom')
                                                <form action="{{ route('admin.notification-types.destroy', $notificationType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.notificationType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.notification-types.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="type" value="custom" id="">

                        <div class="form-group">
                            <label class="required"for="user_type">{{ trans('cruds.notificationType.fields.user_type') }}</label> 
                            <select class="form-control {{ $errors->has('user_type') ? 'is-invalid' : '' }}" name="user_type" id="user_type" required>
                                <option value disabled {{ old('user_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\NotificationType::USER_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('user_type', '') === (string) $key ? 'selected' : '' }}>
                                        {{ trans('options.user_type.'.$key) }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationType.fields.user_type_helper') }}</span>
                        </div> 
                        <div class="form-group">
                            <label class="required"
                                for="name">{{ trans('cruds.notificationType.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationType.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required"
                                for="default_text">{{ trans('cruds.notificationType.fields.default_text') }}</label>
                            <textarea class="form-control {{ $errors->has('default_text') ? 'is-invalid' : '' }}" name="default_text"
                                id="default_text" required>{{ old('default_text') }}</textarea>
                            @if ($errors->has('default_text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('default_text') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.notificationType.fields.default_text_helper') }}</span>
                        </div> 
                        <div class="form-group">
                            <button class="btn btn-success btn-block" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
