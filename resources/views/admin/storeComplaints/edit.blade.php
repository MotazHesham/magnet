@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.storeComplaint.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.store-complaints.update", [$storeComplaint->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="store_id">{{ trans('cruds.storeComplaint.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id">
                    @foreach($stores as $id => $entry)
                        <option value="{{ $id }}" {{ (old('store_id') ? old('store_id') : $storeComplaint->store->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeComplaint.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.storeComplaint.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $storeComplaint->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeComplaint.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reason">{{ trans('cruds.storeComplaint.fields.reason') }}</label>
                <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" name="reason" id="reason">{{ old('reason', $storeComplaint->reason) }}</textarea>
                @if($errors->has('reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeComplaint.fields.reason_helper') }}</span>
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