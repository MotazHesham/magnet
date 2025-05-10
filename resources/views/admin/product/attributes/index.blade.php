@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-md-7">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.attribute.title') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Attribute">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.attribute.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.attribute.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.attribute.fields.values') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attributes as $key => $attribute)
                                    <tr data-entry-id="{{ $attribute->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $attribute->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $attribute->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($attribute->attributeAttributeValues as $attributeValue)
                                                <span class="badge bg-info-transparent">{{ $attributeValue->value ?? '' }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('attribute_show')
                                                <a class="btn btn-xs btn-outline-primary"
                                                    href="{{ route('admin.attributes.show', $attribute->id) }}">
                                                    {{ trans('cruds.attribute.fields.values') }}
                                                </a>
                                            @endcan

                                            @can('attribute_edit')
                                                <a class="btn btn-xs btn-outline-info"
                                                    href="{{ route('admin.attributes.edit', $attribute->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('attribute_delete')
                                                <form action="{{ route('admin.attributes.destroy', $attribute->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-outline-danger"
                                                        value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $attributes->links() }}
                </div>
            </div>

        </div>
        <div class="col-md-5">
            @can('attribute_create') 
                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.attribute.title_singular') }}
                    </div>
                
                    <div class="card-body">
                        <form method="POST" action="{{ route("admin.attributes.store") }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.attribute.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.attribute.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection 
