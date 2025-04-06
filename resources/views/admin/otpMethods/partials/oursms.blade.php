<div class="form-group row">
    <input type="hidden" name="types[]" value="OURSMS_API_KEY">
    <div class="col-lg-3">
        <label class="col-from-label">{{ trans('OURSMS API KEY') }}</label>
    </div>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="OURSMS_API_KEY" value="{{ env('OURSMS_API_KEY') }}"
            placeholder="OURSMS API KEY" required>
    </div>
</div> 

<div class="form-group mb-0 text-right">
    <button type="submit" class="btn btn-lg btn-info">{{ trans('Save') }}</button>
</div>