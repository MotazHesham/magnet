<form class="form-horizontal" action="{{ route('admin.payment-methods.update') }}" method="POST">
    @csrf

    <input type="hidden" name="payment_method" value="edfapay">

    <div class="form-group row">
        <input type="hidden" name="types[]" value="EDFAPAY_MERCHANT_KEY">
        <div class="col-md-4">
            <label class="col-from-label">EDFAPAY MERCHANT KEY</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" name="EDFAPAY_MERCHANT_KEY" value="{{ env('EDFAPAY_MERCHANT_KEY') }}" placeholder="EDFAPAY MERCHANT KEY">
        </div>
        
    </div>
    <div class="form-group row">
        <input type="hidden" name="types[]" value="EDFAPAY_PASS">
        <div class="col-md-4">
            <label class="col-from-label">EDFAPAY PASS</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" name="EDFAPAY_PASS" value="{{ env('EDFAPAY_PASS') }}" placeholder="EDFAPAY PASS">
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">{{ trans('global.save') }}</button>
    </div>
</form>
