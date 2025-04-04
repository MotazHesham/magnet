@extends('layouts.admin')
@section('content')
    <div class="row">
        @foreach ($paymentMethods as $paymentMethod)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex" style="justify-content: space-between">  
                            <h4>{{ ucfirst($paymentMethod->name) }}</h4>
                            <label class="c-switch c-switch-pill c-switch-success">
                                <input onchange="updatePaymentSettings(this)" value="{{ $paymentMethod->id }}" 
                                        type="checkbox" class="c-switch-input" {{ $paymentMethod->active ? 'checked' : '' }}>
                                <span class="c-switch-slider"></span>
                            </label>  
                        </div>
                    </div>

                    <div class="card-body">
                        @include('admin.paymentMethods.partials.'.$paymentMethod->name)
                    </div>
                </div>
            </div>
    @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        
        function updatePaymentSettings(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('admin.payment-methods.update_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status,
            }, function(data) {
                if (data == 1) {
                    showAlert('success', '{{ trans("flash.success") }}', '');
                } else {
                    showAlert('danger', 'Something Went Wrong', '');
                }
            });
        }
    </script>
@endsection
