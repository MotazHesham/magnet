@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.combinedOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.combined-orders.update", [$combinedOrder->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="order_num">{{ trans('cruds.combinedOrder.fields.order_num') }}</label>
                <input class="form-control {{ $errors->has('order_num') ? 'is-invalid' : '' }}" type="text" name="order_num" id="order_num" value="{{ old('order_num', $combinedOrder->order_num) }}">
                @if($errors->has('order_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.combinedOrder.fields.order_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total">{{ trans('cruds.combinedOrder.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total', $combinedOrder->total) }}" step="0.01">
                @if($errors->has('total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.combinedOrder.fields.total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_address">{{ trans('cruds.combinedOrder.fields.shipping_address') }}</label>
                <textarea class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}" name="shipping_address" id="shipping_address">{{ old('shipping_address', $combinedOrder->shipping_address) }}</textarea>
                @if($errors->has('shipping_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.combinedOrder.fields.shipping_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.combinedOrder.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $combinedOrder->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.combinedOrder.fields.user_helper') }}</span>
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