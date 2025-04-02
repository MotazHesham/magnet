@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-7">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.attributeValue.title') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class=" table table-bordered table-striped table-hover datatable datatable-attributeAttributeValues">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.attributeValue.fields.id') }}
                                    </th> 
                                    <th>
                                        {{ trans('cruds.attributeValue.fields.value') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attribute->attributeAttributeValues as $key => $attributeValue)
                                    <tr data-entry-id="{{ $attributeValue->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $attributeValue->id ?? '' }}
                                        </td> 
                                        <td>
                                            {{ $attributeValue->value ?? '' }}
                                        </td>
                                        <td> 

                                            @can('attribute_value_edit')
                                                <a class="btn btn-xs btn-outline-info"
                                                    href="{{ route('admin.attribute-values.edit', $attributeValue->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('attribute_value_delete')
                                                <form
                                                    action="{{ route('admin.attribute-values.destroy', $attributeValue->id) }}"
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
                </div>
            </div> 
        </div>
        <div class="col-md-5">
            @can('attribute_value_create')
                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.attributeValue.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.attribute-values.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="attribute_id" value="{{ $attribute->id }}" id="">
                            <div class="form-group">
                                <label for="name">{{ trans('cruds.attribute.fields.name') }}</label>
                                <input class="form-control" type="text" value="{{ $attribute->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="required" for="value">{{ trans('cruds.attributeValue.fields.value') }}</label>
                                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                    name="value" id="value" value="{{ old('value', '') }}" required>
                                @if ($errors->has('value'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('value') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.attributeValue.fields.value_helper') }}</span>
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
