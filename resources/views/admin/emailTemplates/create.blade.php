@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.emailTemplate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.email-templates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_type">{{ trans('cruds.emailTemplate.fields.user_type') }}</label>
                <input class="form-control {{ $errors->has('user_type') ? 'is-invalid' : '' }}" type="text" name="user_type" id="user_type" value="{{ old('user_type', '') }}" required>
                @if($errors->has('user_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emailTemplate.fields.user_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="identifier">{{ trans('cruds.emailTemplate.fields.identifier') }}</label>
                <input class="form-control {{ $errors->has('identifier') ? 'is-invalid' : '' }}" type="text" name="identifier" id="identifier" value="{{ old('identifier', '') }}" required>
                @if($errors->has('identifier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identifier') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emailTemplate.fields.identifier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_type">{{ trans('cruds.emailTemplate.fields.email_type') }}</label>
                <input class="form-control {{ $errors->has('email_type') ? 'is-invalid' : '' }}" type="text" name="email_type" id="email_type" value="{{ old('email_type', '') }}" required>
                @if($errors->has('email_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emailTemplate.fields.email_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subject">{{ trans('cruds.emailTemplate.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', '') }}" required>
                @if($errors->has('subject'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emailTemplate.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_text">{{ trans('cruds.emailTemplate.fields.default_text') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('default_text') ? 'is-invalid' : '' }}" name="default_text" id="default_text">{!! old('default_text') !!}</textarea>
                @if($errors->has('default_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emailTemplate.fields.default_text_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.emailTemplate.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emailTemplate.fields.status_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.email-templates.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $emailTemplate->id ?? 0 }}');
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

@endsection