@extends('layouts.admin')
@section('content')
    <form method="POST" action="{{ route('admin.stores.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.store.fields.user_info') }}
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                name="email" id="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                name="password" id="password" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="required">{{ trans('cruds.user.fields.phone') }}</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                                name="phone" id="phone" value="{{ old('phone', '') }}" required>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group mt-5">
                            <label>{{ trans('cruds.store.fields.store_location') }}</label>
                            <input style="width: 300px;background: white;margin: 10px;" id="pac-input"
                                class="form-control" type="text" placeholder="Search Place" />
                            <div id="map3" class="mb-4" style="width: 100%; height: 400px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.store.fields.store_info') }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ trans('cruds.store.fields.store_type') }}</label>
                                <select class="form-control {{ $errors->has('store_type') ? 'is-invalid' : '' }}"
                                    name="store_type" id="store_type">
                                    <option value disabled {{ old('store_type', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Store::STORE_TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('store_type', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('store_type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('store_type') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.store_type_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required"
                                    for="store_name">{{ trans('cruds.store.fields.store_name') }}</label>
                                <input class="form-control {{ $errors->has('store_name') ? 'is-invalid' : '' }}"
                                    type="text" name="store_name" id="store_name" value="{{ old('store_name', '') }}"
                                    required>
                                @if ($errors->has('store_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('store_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.store_name_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="logo">{{ trans('cruds.store.fields.logo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                    id="logo-dropzone">
                                </div>
                                @if ($errors->has('logo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('logo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.logo_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    for="commercial_register">{{ trans('cruds.store.fields.commercial_register') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('commercial_register') ? 'is-invalid' : '' }}"
                                    id="commercial_register-dropzone">
                                </div>
                                @if ($errors->has('commercial_register'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('commercial_register') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.store.fields.commercial_register_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">{{ trans('cruds.store.fields.description') }}</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                    id="description">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_id">{{ trans('cruds.store.fields.city') }}</label>
                                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                    name="city_id" id="city_id">
                                    @foreach ($cities as $id => $entry)
                                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.city_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">{{ trans('cruds.store.fields.address') }}</label>
                                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                    type="text" name="address" id="address" value="{{ old('address', '') }}">
                                @if ($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="store_phone">{{ trans('cruds.store.fields.store_phone') }}</label>
                                <input class="form-control {{ $errors->has('store_phone') ? 'is-invalid' : '' }}"
                                    type="text" name="store_phone" id="store_phone"
                                    value="{{ old('store_phone', '') }}">
                                @if ($errors->has('store_phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('store_phone') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.store_phone_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="store_email">{{ trans('cruds.store.fields.store_email') }}</label>
                                <input class="form-control {{ $errors->has('store_email') ? 'is-invalid' : '' }}"
                                    type="email" name="store_email" id="store_email"
                                    value="{{ old('store_email') }}">
                                @if ($errors->has('store_email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('store_email') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.store_email_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="domain">{{ trans('cruds.store.fields.domain') }}</label>
                                <input class="form-control {{ $errors->has('domain') ? 'is-invalid' : '' }}"
                                    type="text" name="domain" id="domain" value="{{ old('domain', '') }}">
                                @if ($errors->has('domain'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('domain') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.domain_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="identity_num">{{ trans('cruds.store.fields.identity_num') }}</label>
                                <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}"
                                    type="text" name="identity_num" id="identity_num"
                                    value="{{ old('identity_num', '') }}">
                                @if ($errors->has('identity_num'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('identity_num') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.identity_num_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    for="commerical_register_num">{{ trans('cruds.store.fields.commerical_register_num') }}</label>
                                <input
                                    class="form-control {{ $errors->has('commerical_register_num') ? 'is-invalid' : '' }}"
                                    type="text" name="commerical_register_num" id="commerical_register_num"
                                    value="{{ old('commerical_register_num', '') }}">
                                @if ($errors->has('commerical_register_num'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('commerical_register_num') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.store.fields.commerical_register_num_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tax_number">{{ trans('cruds.store.fields.tax_number') }}</label>
                                <input class="form-control {{ $errors->has('tax_number') ? 'is-invalid' : '' }}"
                                    type="text" name="tax_number" id="tax_number"
                                    value="{{ old('tax_number', '') }}">
                                @if ($errors->has('tax_number'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tax_number') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.tax_number_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="categories">{{ trans('cruds.store.fields.categories') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}"
                                    name="categories[]" id="categories" multiple>
                                    @foreach ($categories as $id => $category)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categories'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('categories') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.categories_helper') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success btn-block" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            locate();
        });
    </script>
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
            success: function(file, response) {
                $('form').find('input[name="logo"]').remove()
                $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($store) && $store->logo)
                    var file = {!! json_encode($store->logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
            success: function(file, response) {
                $('form').find('input[name="commercial_register"]').remove()
                $('form').append('<input type="hidden" name="commercial_register" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="commercial_register"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($store) && $store->commercial_register)
                    var file = {!! json_encode($store->commercial_register) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="commercial_register" value="' + file.file_name +
                        '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
