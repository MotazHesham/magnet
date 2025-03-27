@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.storeFollower.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.store-followers.update", [$storeFollower->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="store_id">{{ trans('cruds.storeFollower.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id">
                    @foreach($stores as $id => $entry)
                        <option value="{{ $id }}" {{ (old('store_id') ? old('store_id') : $storeFollower->store->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeFollower.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.storeFollower.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $storeFollower->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeFollower.fields.user_helper') }}</span>
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