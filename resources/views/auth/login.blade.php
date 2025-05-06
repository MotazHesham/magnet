<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>منصة ترميم</title>
    <!-- External CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/login/bootstrap.css') }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/login/icon.png') }}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login/wookie-icons.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/login/login-three.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/earlyaccess/amiri.css');

        body {
            font-family: 'amiri';
            font-size: 18px;
        }
    </style>
</head>

<body>
    <!-- Loader -->
    <div class="loaderWrapper">
        <div class="sk-circle">
            <div class="sk-circle1 sk-child"></div>
            <div class="sk-circle2 sk-child"></div>
            <div class="sk-circle3 sk-child"></div>
            <div class="sk-circle4 sk-child"></div>
            <div class="sk-circle5 sk-child"></div>
            <div class="sk-circle6 sk-child"></div>
            <div class="sk-circle7 sk-child"></div>
            <div class="sk-circle8 sk-child"></div>
            <div class="sk-circle9 sk-child"></div>
            <div class="sk-circle10 sk-child"></div>
            <div class="sk-circle11 sk-child"></div>
            <div class="sk-circle12 sk-child"></div>
        </div>
    </div>
    <!-- End Loader -->
    <div
        style="background: url('{{ asset('assets/login/login-background2.jpg') }}') no-repeat;  background-size: cover;">
        <div class="row justify-content-center no-gutters login-box-1 ">
            <div class="col-md-6 d-none d-md-block">
                <div class="login_left ">
                    <div class="loginCenter">
                        <h1 class="text-center">{{ trans('panel.site_title') }}</h1>
                        <p>متجر إلكتروني لبيع المنتجات المختلفة , من خلاله يمكنك التسجيل والدخول للمنصة والاستفادة من جميع المزايا المتاحة</p>
                        <ul class="social-icons">
                            <li><a href="https://www.facebook.com" target="_blank"><i class="icon-g-64"></i></a></li>
                            <li><a href="https://www.gmail.com" target="_blank"><i class="icon-g-87"></i></a></li>
                            <li><a href="https://www.instagram.com" target="_blank"><i class="icon-g-67"></i></a></li>
                            <li><a href="https://www.youtube.com" target="_blank"><i class="icon-g-76"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login_right">
                    <div class="loginCenter">
                        <div class="loginIcon"><i class="icon-f-76"></i></div>
                        <h2>تسجيل الدخول لحسابك</h2>
                        @if(session('message'))
                            <div class="alert alert-info" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="input-field" placeholder="البريد الإلكتروني" required autocomplete="email" autofocus value="{{ old('email', null) }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback" style="display: block !important">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="input-field" placeholder="كلمة المرور" required>
                                @if($errors->has('password'))
                                    <div class="invalid-feedback" style="display: block !important">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-check-block">
                                    <div class="form-check checkbox-theme">
                                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            تذكرني
                                        </label>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="custom-btn">تسجيل الدخول</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- External JS libraries -->
    <script src="{{ asset('assets/login/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/login/popper.min.js') }}"></script>
    <script src="{{ asset('assets/login/bootstrap.min.js') }}"></script>
    <!-- Custom JS Script -->
    <script type="text/javascript">
        $(window).load(function() {
            // Animate loader off screen
            $(".loaderWrapper").fadeOut("slow");;
        });
    </script>
</body>

</html>
