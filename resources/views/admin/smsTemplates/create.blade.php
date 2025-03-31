@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.smsTemplate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sms-templates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="identifier">{{ trans('cruds.smsTemplate.fields.identifier') }}</label>
                <input class="form-control {{ $errors->has('identifier') ? 'is-invalid' : '' }}" type="text" name="identifier" id="identifier" value="{{ old('identifier', '') }}" required>
                @if($errors->has('identifier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identifier') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsTemplate.fields.identifier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sms_body">{{ trans('cruds.smsTemplate.fields.sms_body') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('sms_body') ? 'is-invalid' : '' }}" name="sms_body" id="sms_body">{!! old('sms_body') !!}</textarea>
                @if($errors->has('sms_body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sms_body') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsTemplate.fields.sms_body_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="templateid">{{ trans('cruds.smsTemplate.fields.templateid') }}</label>
                <input class="form-control {{ $errors->has('templateid') ? 'is-invalid' : '' }}" type="text" name="templateid" id="templateid" value="{{ old('templateid', '') }}">
                @if($errors->has('templateid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('templateid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsTemplate.fields.templateid_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.smsTemplate.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsTemplate.fields.status_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.sms-templates.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $smsTemplate->id ?? 0 }}');
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