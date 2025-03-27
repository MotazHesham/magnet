@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productReview.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-reviews.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="rate">{{ trans('cruds.productReview.fields.rate') }}</label>
                <input class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" type="number" name="rate" id="rate" value="{{ old('rate', '') }}" step="1" required>
                @if($errors->has('rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productReview.fields.rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="review">{{ trans('cruds.productReview.fields.review') }}</label>
                <textarea class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}" name="review" id="review">{{ old('review') }}</textarea>
                @if($errors->has('review'))
                    <div class="invalid-feedback">
                        {{ $errors->first('review') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productReview.fields.review_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.productReview.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productReview.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.productReview.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productReview.fields.user_helper') }}</span>
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