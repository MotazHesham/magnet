@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{trans('SMTP Settings')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.bussiness-settings.env_key_update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="MAIL_MAILER">
                        <label class="col-md-3 col-form-label">{{trans('Type')}}</label>
                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker mb-2 mb-md-0" name="MAIL_MAILER" onchange="checkMailDriver()">
                                <option value="sendmail" @if (env('MAIL_MAILER') == "sendmail") selected @endif>{{ trans('Sendmail') }}</option>
                                <option value="smtp" @if (env('MAIL_MAILER') == "smtp") selected @endif>{{ trans('SMTP') }}</option>
                                <option value="mailgun" @if (env('MAIL_MAILER') == "mailgun") selected @endif>{{ trans('Mailgun') }}</option>
                                <option value="log" @if (env('MAIL_MAILER') == "log") selected @endif>{{ trans('LOG') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="smtp">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_HOST">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAIL HOST')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}" placeholder="{{ trans('MAIL HOST') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_PORT">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAIL PORT')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}" placeholder="{{ trans('MAIL PORT') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_USERNAME">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAIL USERNAME')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" placeholder="{{ trans('MAIL USERNAME') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAIL PASSWORD')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}" placeholder="{{ trans('MAIL PASSWORD') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAIL ENCRYPTION')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}" placeholder="{{ trans('MAIL ENCRYPTION') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAIL FROM ADDRESS')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" placeholder="{{ trans('MAIL FROM ADDRESS') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAIL FROM NAME')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{  env('MAIL_FROM_NAME') }}" placeholder="{{ trans('MAIL FROM NAME') }}">
                            </div>
                        </div>
                    </div>
                    <div id="mailgun">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAILGUN DOMAIN')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAILGUN_DOMAIN" value="{{  env('MAILGUN_DOMAIN') }}" placeholder="{{ trans('MAILGUN DOMAIN') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                            <div class="col-md-3">
                                <label class="col-from-label">{{trans('MAILGUN SECRET')}}</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="MAILGUN_SECRET" value="{{  env('MAILGUN_SECRET') }}" placeholder="{{ trans('MAILGUN SECRET') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{trans('Save Configuration')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{trans('Test SMTP configuration')}}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bussiness-settings.test-smtp') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" placeholder="{{ trans('Enter your email address') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">{{ trans('Send test email') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{trans('Instruction')}}</h5>
            </div>
            <div class="card-body">
                <p class="text-danger">{{ trans('Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.') }}</p>
                <h6 class="text-muted">{{ trans('For Non-SSL') }}</h6>
                <ul class="list-group">
                    <li class="list-group-item text-dark">{{ trans('Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ') }}</li>
                    <li class="list-group-item text-dark">{{ trans('Set Mail Host according to your server Mail Client Manual Settings') }}</li>
                    <li class="list-group-item text-dark">{{ trans('Set Mail port as 587') }}</li>
                    <li class="list-group-item text-dark">{{ trans('Set Mail Encryption as ssl if you face issue with tls') }}</li>
                </ul>
                <br>
                <h6 class="text-muted">{{ trans('For SSL') }}</h6>
                <ul class="list-group mar-no">
                    <li class="list-group-item text-dark">{{ trans('Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver') }}</li>
                    <li class="list-group-item text-dark">{{ trans('Set Mail Host according to your server Mail Client Manual Settings') }}</li>
                    <li class="list-group-item text-dark">{{ trans('Set Mail port as 465') }}</li>
                    <li class="list-group-item text-dark">{{ trans('Set Mail Encryption as ssl') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            checkMailDriver();
        });
        function checkMailDriver(){
            if($('select[name=MAIL_DRIVER]').val() == 'mailgun'){
                $('#mailgun').show();
                $('#smtp').hide();
            }
            else{
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>

@endsection
