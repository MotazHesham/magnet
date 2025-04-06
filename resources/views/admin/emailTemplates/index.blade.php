@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.emailTemplate.title') }}
            <div class="mt-4">
                <a href="{{ route('admin.email-templates.index',['user_type' => 'customer']) }}" 
                    class="btn mr-2 @if(request('user_type','customer') == 'customer') btn-info  @else btn-default @endif">
                    {{ trans('options.user_type.customer') }}
                </a>
                <a href="{{ route('admin.email-templates.index',['user_type' => 'seller']) }}" 
                    class="btn mr-2 @if(request('user_type','customer') == 'seller') btn-info  @else btn-default @endif">
                    {{ trans('options.user_type.seller') }}
                </a>
                <a href="{{ route('admin.email-templates.index',['user_type' => 'staff']) }}" 
                    class="btn mr-2 @if(request('user_type','customer') == 'staff') btn-info  @else btn-default @endif">
                    {{ trans('options.user_type.staff') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EmailTemplate">
                <thead>
                    <tr>
                        <th width="10">

                        </th>  
                        <th>
                            {{ trans('cruds.emailTemplate.fields.email_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.subject') }}
                        </th>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emailTemplates as $key => $emailTemplate)
                        <tr>
                            <td></td>
                            <td> {{ $emailTemplate->email_type }} </td>
                            <td> {{ $emailTemplate->subject }} </td>
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="updateStatuses(this, 'status', 'App\\Models\\EmailTemplate')" 
                                        value="{{ $emailTemplate->id }}" 
                                        type="checkbox" 
                                        class="c-switch-input" {{ $emailTemplate->status ? 'checked' : '' }}>
                                    <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                @can('email_template_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.email-templates.edit', $emailTemplate->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 
