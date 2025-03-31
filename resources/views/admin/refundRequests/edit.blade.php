@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.refundRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.refund-requests.update", [$refundRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.refundRequest.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $refundRequest->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="special_order_id">{{ trans('cruds.refundRequest.fields.special_order') }}</label>
                <select class="form-control select2 {{ $errors->has('special_order') ? 'is-invalid' : '' }}" name="special_order_id" id="special_order_id">
                    @foreach($special_orders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('special_order_id') ? old('special_order_id') : $refundRequest->special_order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('special_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('special_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.special_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_id">{{ trans('cruds.refundRequest.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $refundRequest->order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_detail_id">{{ trans('cruds.refundRequest.fields.order_detail') }}</label>
                <select class="form-control select2 {{ $errors->has('order_detail') ? 'is-invalid' : '' }}" name="order_detail_id" id="order_detail_id">
                    @foreach($order_details as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_detail_id') ? old('order_detail_id') : $refundRequest->order_detail->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_detail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_detail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.order_detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="store_id">{{ trans('cruds.refundRequest.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id" required>
                    @foreach($stores as $id => $entry)
                        <option value="{{ $id }}" {{ (old('store_id') ? old('store_id') : $refundRequest->store->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reason">{{ trans('cruds.refundRequest.fields.reason') }}</label>
                <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" name="reason" id="reason">{{ old('reason', $refundRequest->reason) }}</textarea>
                @if($errors->has('reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.reason_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="refund_amount">{{ trans('cruds.refundRequest.fields.refund_amount') }}</label>
                <input class="form-control {{ $errors->has('refund_amount') ? 'is-invalid' : '' }}" type="number" name="refund_amount" id="refund_amount" value="{{ old('refund_amount', $refundRequest->refund_amount) }}" step="0.01" required>
                @if($errors->has('refund_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refund_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.refund_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('store_approval') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="store_approval" value="0">
                    <input class="form-check-input" type="checkbox" name="store_approval" id="store_approval" value="1" {{ $refundRequest->store_approval || old('store_approval', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="store_approval">{{ trans('cruds.refundRequest.fields.store_approval') }}</label>
                </div>
                @if($errors->has('store_approval'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_approval') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.store_approval_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('admin_approval') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="admin_approval" value="0">
                    <input class="form-check-input" type="checkbox" name="admin_approval" id="admin_approval" value="1" {{ $refundRequest->admin_approval || old('admin_approval', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="admin_approval">{{ trans('cruds.refundRequest.fields.admin_approval') }}</label>
                </div>
                @if($errors->has('admin_approval'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admin_approval') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.admin_approval_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reject_reason">{{ trans('cruds.refundRequest.fields.reject_reason') }}</label>
                <textarea class="form-control {{ $errors->has('reject_reason') ? 'is-invalid' : '' }}" name="reject_reason" id="reject_reason">{{ old('reject_reason', $refundRequest->reject_reason) }}</textarea>
                @if($errors->has('reject_reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reject_reason') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.reject_reason_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="invoice_photo">{{ trans('cruds.refundRequest.fields.invoice_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('invoice_photo') ? 'is-invalid' : '' }}" id="invoice_photo-dropzone">
                </div>
                @if($errors->has('invoice_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('invoice_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.invoice_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_photo">{{ trans('cruds.refundRequest.fields.product_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('product_photo') ? 'is-invalid' : '' }}" id="product_photo-dropzone">
                </div>
                @if($errors->has('product_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.product_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.refundRequest.fields.refund_status') }}</label>
                <select class="form-control {{ $errors->has('refund_status') ? 'is-invalid' : '' }}" name="refund_status" id="refund_status">
                    <option value disabled {{ old('refund_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RefundRequest::REFUND_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('refund_status', $refundRequest->refund_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('refund_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refund_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.refundRequest.fields.refund_status_helper') }}</span>
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
    Dropzone.options.invoicePhotoDropzone = {
    url: '{{ route('admin.refund-requests.storeMedia') }}',
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
      $('form').find('input[name="invoice_photo"]').remove()
      $('form').append('<input type="hidden" name="invoice_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="invoice_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($refundRequest) && $refundRequest->invoice_photo)
      var file = {!! json_encode($refundRequest->invoice_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="invoice_photo" value="' + file.file_name + '">')
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
    Dropzone.options.productPhotoDropzone = {
    url: '{{ route('admin.refund-requests.storeMedia') }}',
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
      $('form').find('input[name="product_photo"]').remove()
      $('form').append('<input type="hidden" name="product_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="product_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($refundRequest) && $refundRequest->product_photo)
      var file = {!! json_encode($refundRequest->product_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="product_photo" value="' + file.file_name + '">')
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