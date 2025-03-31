@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.store.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.stores.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.store.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.store.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.store.fields.store_type') }}</label>
                <select class="form-control {{ $errors->has('store_type') ? 'is-invalid' : '' }}" name="store_type" id="store_type">
                    <option value disabled {{ old('store_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Store::STORE_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('store_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('store_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.store_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="store_name">{{ trans('cruds.store.fields.store_name') }}</label>
                <input class="form-control {{ $errors->has('store_name') ? 'is-invalid' : '' }}" type="text" name="store_name" id="store_name" value="{{ old('store_name', '') }}" required>
                @if($errors->has('store_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.store_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="logo">{{ trans('cruds.store.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.store.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city_id">{{ trans('cruds.store.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.store.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_phone">{{ trans('cruds.store.fields.store_phone') }}</label>
                <input class="form-control {{ $errors->has('store_phone') ? 'is-invalid' : '' }}" type="text" name="store_phone" id="store_phone" value="{{ old('store_phone', '') }}">
                @if($errors->has('store_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.store_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_email">{{ trans('cruds.store.fields.store_email') }}</label>
                <input class="form-control {{ $errors->has('store_email') ? 'is-invalid' : '' }}" type="email" name="store_email" id="store_email" value="{{ old('store_email') }}">
                @if($errors->has('store_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.store_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="domain">{{ trans('cruds.store.fields.domain') }}</label>
                <input class="form-control {{ $errors->has('domain') ? 'is-invalid' : '' }}" type="text" name="domain" id="domain" value="{{ old('domain', '') }}">
                @if($errors->has('domain'))
                    <div class="invalid-feedback">
                        {{ $errors->first('domain') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.domain_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commercial_register">{{ trans('cruds.store.fields.commercial_register') }}</label>
                <div class="needsclick dropzone {{ $errors->has('commercial_register') ? 'is-invalid' : '' }}" id="commercial_register-dropzone">
                </div>
                @if($errors->has('commercial_register'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commercial_register') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.commercial_register_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.store.fields.categories') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.categories_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identity_num">{{ trans('cruds.store.fields.identity_num') }}</label>
                <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="text" name="identity_num" id="identity_num" value="{{ old('identity_num', '') }}">
                @if($errors->has('identity_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identity_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.identity_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commerical_register_num">{{ trans('cruds.store.fields.commerical_register_num') }}</label>
                <input class="form-control {{ $errors->has('commerical_register_num') ? 'is-invalid' : '' }}" type="text" name="commerical_register_num" id="commerical_register_num" value="{{ old('commerical_register_num', '') }}">
                @if($errors->has('commerical_register_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_register_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.commerical_register_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tax_number">{{ trans('cruds.store.fields.tax_number') }}</label>
                <input class="form-control {{ $errors->has('tax_number') ? 'is-invalid' : '' }}" type="text" name="tax_number" id="tax_number" value="{{ old('tax_number', '') }}">
                @if($errors->has('tax_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tax_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.tax_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rating">{{ trans('cruds.store.fields.rating') }}</label>
                <input class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}" type="number" name="rating" id="rating" value="{{ old('rating', '') }}" step="0.01">
                @if($errors->has('rating'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rating') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.rating_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.store.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.store.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.longitude_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.stores.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($store) && $store->logo)
      var file = {!! json_encode($store->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    Dropzone.options.commercialRegisterDropzone = {
    url: '{{ route('admin.stores.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="commercial_register"]').remove()
      $('form').append('<input type="hidden" name="commercial_register" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="commercial_register"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($store) && $store->commercial_register)
      var file = {!! json_encode($store->commercial_register) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="commercial_register" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection