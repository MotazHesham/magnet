@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.customers.update", [$customer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.customer.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $customer->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wallet_balance">{{ trans('cruds.customer.fields.wallet_balance') }}</label>
                <input class="form-control {{ $errors->has('wallet_balance') ? 'is-invalid' : '' }}" type="number" name="wallet_balance" id="wallet_balance" value="{{ old('wallet_balance', $customer->wallet_balance) }}" step="0.01">
                @if($errors->has('wallet_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wallet_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.wallet_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="points">{{ trans('cruds.customer.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', $customer->points) }}" step="1">
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.points_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('can_scratch') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="can_scratch" value="0">
                    <input class="form-check-input" type="checkbox" name="can_scratch" id="can_scratch" value="1" {{ $customer->can_scratch || old('can_scratch', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="can_scratch">{{ trans('cruds.customer.fields.can_scratch') }}</label>
                </div>
                @if($errors->has('can_scratch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('can_scratch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.can_scratch_helper') }}</span>
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