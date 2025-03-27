@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.popup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.popups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.id') }}
                        </th>
                        <td>
                            {{ $popup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.title') }}
                        </th>
                        <td>
                            {{ $popup->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.image') }}
                        </th>
                        <td>
                            @if($popup->image)
                                <a href="{{ $popup->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $popup->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $popup->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.popups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection