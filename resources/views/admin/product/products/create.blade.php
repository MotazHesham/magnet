@extends('layouts.admin')
@section('content')
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="store_product">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"> 
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="store_id">{{ trans('cruds.product.fields.store') }}</label>
                                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}"
                                    name="store_id" id="store_id">
                                    @foreach ($stores as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('store_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('store'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('store') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.store_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                    name="name" id="name" value="{{ old('name', '') }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required"
                                    for="product_categories">{{ trans('cruds.product.fields.product_categories') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select
                                    class="form-control select2 {{ $errors->has('product_categories') ? 'is-invalid' : '' }}"
                                    name="product_categories[]" id="product_categories" multiple required>
                                    @foreach ($product_categories as $id => $product_category)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('product_categories', [])) ? 'selected' : '' }}>
                                            {{ $product_category }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_categories'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('product_categories') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.product_categories_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="brand_id">{{ trans('cruds.product.fields.brand') }}</label>
                                <select class="form-control select2 {{ $errors->has('brand') ? 'is-invalid' : '' }}"
                                    name="brand_id" id="brand_id">
                                    @foreach ($brands as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('brand_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('brand') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.brand_helper') }}</span>
                            </div> 
                            <div class="form-group col-md-12">
                                <label for="tags">{{ trans('cruds.product.fields.tags') }}</label>
                                <input class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="text"
                                    name="tags[]" id="tags" placeholder="add tags ..." data-role="tagsinput">
                                @if ($errors->has('tags'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tags') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.tags_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                    id="description">{!! old('description') !!}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="meta_title">{{ trans('cruds.product.fields.meta_title') }}</label>
                                <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                    type="text" name="meta_title" id="meta_title"
                                    value="{{ old('meta_title', '') }}">
                                @if ($errors->has('meta_title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('meta_title') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.meta_title_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="meta_description">{{ trans('cruds.product.fields.meta_description') }}</label>
                                <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description"
                                    id="meta_description">{{ old('meta_description') }}</textarea>
                                @if ($errors->has('meta_description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('meta_description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.meta_description_helper') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="main_photo">{{ trans('cruds.product.fields.main_photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('main_photo') ? 'is-invalid' : '' }}"
                                    id="main_photo-dropzone">
                                </div>
                                @if ($errors->has('main_photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('main_photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.main_photo_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="photos">{{ trans('cruds.product.fields.photos') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}"
                                    id="photos-dropzone">
                                </div>
                                @if ($errors->has('photos'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('photos') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.photos_helper') }}</span>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-check {{ $errors->has('refundable') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="refundable" value="1">
                                    <input class="form-check-input" type="checkbox" name="refundable" id="refundable"
                                        value="1" {{ old('refundable', 1) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="refundable">{{ trans('cruds.product.fields.refundable') }}</label>
                                </div>
                                @if ($errors->has('refundable'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('refundable') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.refundable_helper') }}</span>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-check {{ $errors->has('featured') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="featured" value="0">
                                    <input class="form-check-input" type="checkbox" name="featured" id="featured"
                                        value="1" {{ old('featured', 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="featured">{{ trans('cruds.product.fields.featured') }}</label>
                                </div>
                                @if ($errors->has('featured'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('featured') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.featured_helper') }}</span>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="approved" value="1">
                                    <input class="form-check-input" type="checkbox" name="approved" id="approved"
                                        value="1" {{ old('approved', 1) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="approved">{{ trans('cruds.product.fields.approved') }}</label>
                                </div>
                                @if ($errors->has('approved'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('approved') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.approved_helper') }}</span>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="published" value="1">
                                    <input class="form-check-input" type="checkbox" name="published" id="published"
                                        value="1" {{ old('published', 1) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="published">{{ trans('cruds.product.fields.published') }}</label>
                                </div>
                                @if ($errors->has('published'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('published') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.published_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required"
                                    for="purchase_price">{{ trans('cruds.product.fields.purchase_price') }}</label>
                                <input class="form-control {{ $errors->has('purchase_price') ? 'is-invalid' : '' }}"
                                    type="number" name="purchase_price" id="purchase_price"
                                    value="{{ old('purchase_price', '') }}" step="0.01" required>
                                @if ($errors->has('purchase_price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('purchase_price') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.purchase_price_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required"
                                    for="unit_price">{{ trans('cruds.product.fields.unit_price') }}</label>
                                <input class="form-control {{ $errors->has('unit_price') ? 'is-invalid' : '' }}"
                                    type="number" name="unit_price" id="unit_price"
                                    value="{{ old('unit_price', '') }}" step="0.01" required>
                                @if ($errors->has('unit_price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('unit_price') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.unit_price_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="discount">{{ trans('cruds.product.fields.discount') }}</label>
                                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                    type="number" name="discount" id="discount" value="{{ old('discount', '') }}"
                                    step="0.01">
                                @if ($errors->has('discount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('discount') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.discount_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ trans('cruds.product.fields.discount_type') }}</label>
                                <select class="form-control {{ $errors->has('discount_type') ? 'is-invalid' : '' }}"
                                    name="discount_type" id="discount_type">
                                    <option value disabled {{ old('discount_type', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Product::DISCOUNT_TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('discount_type', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('discount_type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('discount_type') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.discount_type_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="current_stock">{{ trans('cruds.product.fields.current_stock') }}</label>
                                <input class="form-control {{ $errors->has('current_stock') ? 'is-invalid' : '' }}"
                                    type="number" name="current_stock" id="current_stock"
                                    value="{{ old('current_stock', 0) }}" step="1">
                                @if ($errors->has('current_stock'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('current_stock') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.current_stock_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sku">{{ trans('cruds.product.fields.sku') }}</label>
                                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text"
                                    name="sku" id="sku" value="{{ old('sku', '') }}">
                                @if ($errors->has('sku'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('sku') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.sku_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ trans('cruds.product.fields.colors') }}</label>
                                <select class="form-control select2 {{ $errors->has('colors') ? 'is-invalid' : '' }}"
                                    name="colors[]" id="colors" multiple>
                                    @foreach ($colors as $key => $label)
                                        <option value="{{ $key }}" data-color="{{ $key }}"
                                            {{ old('colors', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }} 
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('colors'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('colors') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.colors_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ trans('cruds.product.fields.attributes') }}</label>
                                <select class="form-control select2 {{ $errors->has('attributes') ? 'is-invalid' : '' }}" name="attributes[]" id="attributes" multiple>
                                    @foreach ($attributes as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('attributes', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('attributes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('attributes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.attributes_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <div id="attributes-options">

                                </div>
                                <div id="sku-combination" style="max-height: 300px; overflow-x: hidden; overflow-y: scroll;">

                                </div>
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
        $(document).ready(function () {
            function formatColorOption(option) {
                if (!option.id) {
                    return option.text;
                }
                var color = $(option.element).data("color");
                var $option = $(
                    `<span>
                        <div style="display:inline-block;width:15px;height:15px;background:${color};border-radius:50%;margin-right:5px;"></div>
                        ${option.text}
                    </span>`
                );
                return $option;
            }

            $("#colors").select2({
                templateResult: formatColorOption,
                templateSelection: formatColorOption
            });
        });
        $('#colors').on('change', function() {
            update_sku();
        });

        $('#attributes').on('change', function() {
            update_attribute_options();
        }); 

        function update_attribute_options(){
            $('#attributes-options').html(null);
            $.ajax({
                type: "POST",
                url: '{{ route('admin.products.attribute_options') }}',
                data: {
                    selectedAttributes: $('#attributes').val(),
                    _token : '{{ csrf_token() }}'
                },
                success: function(data) { 
                    $('#attributes-options').html(data);
                    update_sku();
                    $('.select2-ajax').select2();
                }
            });
        }

        function update_sku() {
            $.ajax({
                type: "POST",
                url: '{{ route('admin.products.sku_combination') }}',
                data: $('#store_product').serialize(),
                success: function(data) {
                    $('#sku-combination').html(data);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('admin.products.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $product->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>

    <script>
        Dropzone.options.mainPhotoDropzone = {
            url: '{{ route('admin.products.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="main_photo"]').remove()
                $('form').append('<input type="hidden" name="main_photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="main_photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($product) && $product->main_photo)
                    var file = {!! json_encode($product->main_photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="main_photo" value="' + file.file_name + '">')
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
        var uploadedPhotosMap = {}
        Dropzone.options.photosDropzone = {
            url: '{{ route('admin.products.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
                uploadedPhotosMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedPhotosMap[file.name]
                }
                $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($product) && $product->photos)
                    var files = {!! json_encode($product->photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
                    }
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
