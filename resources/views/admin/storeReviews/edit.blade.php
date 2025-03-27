@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.storeReview.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.store-reviews.update", [$storeReview->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="store_id">{{ trans('cruds.storeReview.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id">
                    @foreach($stores as $id => $entry)
                        <option value="{{ $id }}" {{ (old('store_id') ? old('store_id') : $storeReview->store->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeReview.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.storeReview.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $storeReview->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeReview.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rate">{{ trans('cruds.storeReview.fields.rate') }}</label>
                <input class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" type="number" name="rate" id="rate" value="{{ old('rate', $storeReview->rate) }}" step="1">
                @if($errors->has('rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeReview.fields.rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="review">{{ trans('cruds.storeReview.fields.review') }}</label>
                <textarea class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}" name="review" id="review">{{ old('review', $storeReview->review) }}</textarea>
                @if($errors->has('review'))
                    <div class="invalid-feedback">
                        {{ $errors->first('review') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeReview.fields.review_helper') }}</span>
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