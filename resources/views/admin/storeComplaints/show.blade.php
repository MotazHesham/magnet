@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.storeComplaint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-complaints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.storeComplaint.fields.id') }}
                        </th>
                        <td>
                            {{ $storeComplaint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeComplaint.fields.store') }}
                        </th>
                        <td>
                            {{ $storeComplaint->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeComplaint.fields.user') }}
                        </th>
                        <td>
                            {{ $storeComplaint->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeComplaint.fields.reason') }}
                        </th>
                        <td>
                            {{ $storeComplaint->reason }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-complaints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection