@extends('layouts.admin')
@section('content')
    <div class="row">
        @foreach ($otpMethods as $otpMethod)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex" style="justify-content: space-between">  
                            <h4>{{ ucfirst($otpMethod->type) }}</h4>
                            <label class="c-switch c-switch-pill c-switch-success">
                                <input onchange="updateOtpStatus(this)" value="{{ $otpMethod->id }}" 
                                        type="checkbox" class="c-switch-input" {{ $otpMethod->status ? 'checked' : '' }}>
                                <span class="c-switch-slider"></span>
                            </label>  
                        </div>
                    </div>

                    <div class="card-body">
                        @include('admin.otpMethods.partials.'.$otpMethod->type)
                    </div>
                </div>
            </div>
    @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        
        function updateOtpStatus(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('admin.otp-methods.update_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status,
            }, function(data) {
                if (data == 1) {
                    showAlert('success', '{{ trans("flash.success") }}', '');
                    location.reload();
                } else {
                    showAlert('danger', 'Something Went Wrong', '');
                }
            });
        }
    </script>
@endsection
