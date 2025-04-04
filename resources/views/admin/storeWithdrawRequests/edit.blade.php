@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.storeWithdrawRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.store-withdraw-requests.update", [$storeWithdrawRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf  

            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.storeWithdrawRequest.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $storeWithdrawRequest->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeWithdrawRequest.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.storeWithdrawRequest.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $storeWithdrawRequest->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storeWithdrawRequest.fields.note_helper') }}</span>
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