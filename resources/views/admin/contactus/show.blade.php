@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contactus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contactu.fields.id') }}
                        </th>
                        <td>
                            {{ $contactu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactu.fields.name') }}
                        </th>
                        <td>
                            {{ $contactu->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactu.fields.phone') }}
                        </th>
                        <td>
                            {{ $contactu->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactu.fields.message') }}
                        </th>
                        <td>
                            {{ $contactu->message }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contactus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection