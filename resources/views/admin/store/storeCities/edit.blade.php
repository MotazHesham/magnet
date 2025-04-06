@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.storeCity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.store-cities.update", [$storeCity->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="store_id" value="{{ $storeCity->store_id }}" id="">
            <input type="hidden" name="city_id" value="{{ $storeCity->city_id }}" id="">
            
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.storeCity.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $storeCity->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeCity.fields.price_helper') }}</span>
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