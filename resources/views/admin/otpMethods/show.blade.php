@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.otpMethod.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.otp-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.otpMethod.fields.id') }}
                        </th>
                        <td>
                            {{ $otpMethod->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpMethod.fields.type') }}
                        </th>
                        <td>
                            {{ $otpMethod->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpMethod.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $otpMethod->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.otp-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection