@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.scratch.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scratches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.scratch.fields.id') }}
                        </th>
                        <td>
                            {{ $scratch->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scratch.fields.name') }}
                        </th>
                        <td>
                            {{ $scratch->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scratch.fields.code') }}
                        </th>
                        <td>
                            {{ $scratch->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scratch.fields.discount_type') }}
                        </th>
                        <td>
                            {{ App\Models\Scratch::DISCOUNT_TYPE_SELECT[$scratch->discount_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scratch.fields.discount') }}
                        </th>
                        <td>
                            {{ $scratch->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scratch.fields.expiration_days') }}
                        </th>
                        <td>
                            {{ $scratch->expiration_days }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scratches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection