@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.emailTemplate.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.email-templates.update', [$emailTemplate->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="email_type">{{ trans('cruds.emailTemplate.fields.email_type') }}</label>
                    <input class="form-control" type="text" readonly
                        value="{{ old('email_type', $emailTemplate->email_type) }}">
                </div>
                <div class="form-group">
                    <label class="required" for="subject">{{ trans('cruds.emailTemplate.fields.subject') }}</label>
                    <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text"
                        name="subject" id="subject" value="{{ old('subject', $emailTemplate->subject) }}" required>
                    @if ($errors->has('subject'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.emailTemplate.fields.subject_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="default_text">{{ trans('cruds.emailTemplate.fields.default_text') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('default_text') ? 'is-invalid' : '' }}" name="default_text"
                        id="default_text">{!! old('default_text', $emailTemplate->default_text) !!}</textarea>
                    @if ($errors->has('default_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('default_text') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.emailTemplate.fields.default_text_helper') }}</span>
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
                                            '{{ route('admin.email-templates.storeCKEditorImages') }}',
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
                                        data.append('crud_id',
                                        '{{ $emailTemplate->id ?? 0 }}');
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
