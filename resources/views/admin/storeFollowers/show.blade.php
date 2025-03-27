@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.storeFollower.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-followers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.storeFollower.fields.id') }}
                        </th>
                        <td>
                            {{ $storeFollower->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeFollower.fields.store') }}
                        </th>
                        <td>
                            {{ $storeFollower->store->store_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storeFollower.fields.user') }}
                        </th>
                        <td>
                            {{ $storeFollower->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.store-followers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection