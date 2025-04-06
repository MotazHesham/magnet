@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="parent_id">{{ trans('cruds.productCategory.fields.parent') }}</label>
                    <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id">
                        @foreach($parents as $id => $entry)
                            <option value="{{ $id }}" {{ old('parent_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('parent'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parent') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productCategory.fields.parent_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="name">{{ trans('cruds.productCategory.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productCategory.fields.name_helper') }}</span>
                </div> 
                <div class="form-group col-md-4">
                    <label class="required" for="order_level">{{ trans('cruds.productCategory.fields.order_level') }}</label>
                    <input class="form-control {{ $errors->has('order_level') ? 'is-invalid' : '' }}" type="number" name="order_level" id="order_level" value="{{ old('order_level', '0') }}" step="1" required>
                    @if($errors->has('order_level'))
                        <div class="invalid-feedback">
                            {{ $errors->first('order_level') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productCategory.fields.order_level_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="banner">{{ trans('cruds.productCategory.fields.banner') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('banner') ? 'is-invalid' : '' }}" id="banner-dropzone">
                    </div>
                    @if($errors->has('banner'))
                        <div class="invalid-feedback">
                            {{ $errors->first('banner') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productCategory.fields.banner_helper') }}</span>
                </div> 
                <div class="form-group col-md-12">
                    <label for="meta_title">{{ trans('cruds.productCategory.fields.meta_title') }}</label>
                    <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', '') }}">
                    @if($errors->has('meta_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productCategory.fields.meta_title_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="meta_description">{{ trans('cruds.productCategory.fields.meta_description') }}</label>
                    <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                    @if($errors->has('meta_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productCategory.fields.meta_description_helper') }}</span>
                </div>
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
    Dropzone.options.bannerDropzone = {
    url: '{{ route('admin.product-categories.storeMedia') }}',
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
    success: function (file, response) {
      $('form').find('input[name="banner"]').remove()
      $('form').append('<input type="hidden" name="banner" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($productCategory) && $productCategory->banner)
      var file = {!! json_encode($productCategory->banner) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner" value="' + file.file_name + '">')
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