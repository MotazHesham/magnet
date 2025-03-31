@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.search.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.searches.update", [$search->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="query">{{ trans('cruds.search.fields.query') }}</label>
                <input class="form-control {{ $errors->has('query') ? 'is-invalid' : '' }}" type="text" name="query" id="query" value="{{ old('query', $search->query) }}" required>
                @if($errors->has('query'))
                    <div class="invalid-feedback">
                        {{ $errors->first('query') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.search.fields.query_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="count">{{ trans('cruds.search.fields.count') }}</label>
                <input class="form-control {{ $errors->has('count') ? 'is-invalid' : '' }}" type="number" name="count" id="count" value="{{ old('count', $search->count) }}" step="1" required>
                @if($errors->has('count'))
                    <div class="invalid-feedback">
                        {{ $errors->first('count') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.search.fields.count_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection