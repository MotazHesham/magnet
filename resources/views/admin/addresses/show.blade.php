@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.address.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.id') }}
                        </th>
                        <td>
                            {{ $address->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.user') }}
                        </th>
                        <td>
                            {{ $address->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.name') }}
                        </th>
                        <td>
                            {{ $address->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.region') }}
                        </th>
                        <td>
                            {{ $address->region->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.city') }}
                        </th>
                        <td>
                            {{ $address->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.district') }}
                        </th>
                        <td>
                            {{ $address->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.address') }}
                        </th>
                        <td>
                            {{ $address->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.is_default') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $address->is_default ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection