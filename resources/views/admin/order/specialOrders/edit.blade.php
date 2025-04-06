@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.specialOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.special-orders.update", [$specialOrder->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="order_num">{{ trans('cruds.specialOrder.fields.order_num') }}</label>
                <input class="form-control {{ $errors->has('order_num') ? 'is-invalid' : '' }}" type="text" name="order_num" id="order_num" value="{{ old('order_num', $specialOrder->order_num) }}">
                @if($errors->has('order_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.order_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.specialOrder.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $specialOrder->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="store_id">{{ trans('cruds.specialOrder.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id" required>
                    @foreach($stores as $id => $entry)
                        <option value="{{ $id }}" {{ (old('store_id') ? old('store_id') : $specialOrder->store->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.store_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.specialOrder.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="color">{{ trans('cruds.specialOrder.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', $specialOrder->color) }}">
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="category_id">{{ trans('cruds.specialOrder.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $specialOrder->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="variations">{{ trans('cruds.specialOrder.fields.variations') }}</label>
                <textarea class="form-control {{ $errors->has('variations') ? 'is-invalid' : '' }}" name="variations" id="variations" required>{{ old('variations', $specialOrder->variations) }}</textarea>
                @if($errors->has('variations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('variations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.variations_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.specialOrder.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $specialOrder->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.specialOrder.fields.delivery_status') }}</label>
                <select class="form-control {{ $errors->has('delivery_status') ? 'is-invalid' : '' }}" name="delivery_status" id="delivery_status" required>
                    <option value disabled {{ old('delivery_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SpecialOrder::DELIVERY_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('delivery_status', $specialOrder->delivery_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.delivery_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.specialOrder.fields.offer_price_status') }}</label>
                <select class="form-control {{ $errors->has('offer_price_status') ? 'is-invalid' : '' }}" name="offer_price_status" id="offer_price_status" required>
                    <option value disabled {{ old('offer_price_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SpecialOrder::OFFER_PRICE_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('offer_price_status', $specialOrder->offer_price_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('offer_price_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('offer_price_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.offer_price_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.specialOrder.fields.payment_method') }}</label>
                <select class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method" id="payment_method">
                    <option value disabled {{ old('payment_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SpecialOrder::PAYMENT_METHOD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_method', $specialOrder->payment_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.specialOrder.fields.payment_status') }}</label>
                <select class="form-control {{ $errors->has('payment_status') ? 'is-invalid' : '' }}" name="payment_status" id="payment_status" required>
                    <option value disabled {{ old('payment_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SpecialOrder::PAYMENT_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_status', $specialOrder->payment_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.payment_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_data">{{ trans('cruds.specialOrder.fields.payment_data') }}</label>
                <textarea class="form-control {{ $errors->has('payment_data') ? 'is-invalid' : '' }}" name="payment_data" id="payment_data">{{ old('payment_data', $specialOrder->payment_data) }}</textarea>
                @if($errors->has('payment_data'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_data') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.payment_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_address">{{ trans('cruds.specialOrder.fields.shipping_address') }}</label>
                <textarea class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}" name="shipping_address" id="shipping_address">{{ old('shipping_address', $specialOrder->shipping_address) }}</textarea>
                @if($errors->has('shipping_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.shipping_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_cost">{{ trans('cruds.specialOrder.fields.shipping_cost') }}</label>
                <input class="form-control {{ $errors->has('shipping_cost') ? 'is-invalid' : '' }}" type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $specialOrder->shipping_cost) }}" step="0.01">
                @if($errors->has('shipping_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.shipping_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total">{{ trans('cruds.specialOrder.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total', $specialOrder->total) }}" step="0.01">
                @if($errors->has('total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialOrder.fields.total_helper') }}</span>
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
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.special-orders.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($specialOrder) && $specialOrder->files)
          var files =
            {!! json_encode($specialOrder->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
            }
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