@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customerScratch.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.customer-scratches.update", [$customerScratch->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.customerScratch.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $customerScratch->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerScratch.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="scratch_id">{{ trans('cruds.customerScratch.fields.scratch') }}</label>
                <select class="form-control select2 {{ $errors->has('scratch') ? 'is-invalid' : '' }}" name="scratch_id" id="scratch_id" required>
                    @foreach($scratches as $id => $entry)
                        <option value="{{ $id }}" {{ (old('scratch_id') ? old('scratch_id') : $customerScratch->scratch->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('scratch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scratch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerScratch.fields.scratch_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('used') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="used" id="used" value="1" {{ $customerScratch->used || old('used', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="used">{{ trans('cruds.customerScratch.fields.used') }}</label>
                </div>
                @if($errors->has('used'))
                    <div class="invalid-feedback">
                        {{ $errors->first('used') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerScratch.fields.used_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expire_at">{{ trans('cruds.customerScratch.fields.expire_at') }}</label>
                <input class="form-control date {{ $errors->has('expire_at') ? 'is-invalid' : '' }}" type="text" name="expire_at" id="expire_at" value="{{ old('expire_at', $customerScratch->expire_at) }}" required>
                @if($errors->has('expire_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expire_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerScratch.fields.expire_at_helper') }}</span>
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