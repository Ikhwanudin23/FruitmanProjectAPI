<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V12</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('assets/AssetsLoginForm/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AssetsLoginForm/css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('assets/AssetsLoginForm/images/img-01.jpg')}}');">
        <div class="wrap-login100 p-t-190 p-b-30">
            <form class="login100-form validate-form" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="login100-form-avatar">
                    <img src="{{asset('assets/AssetsLoginForm/images/avatar-01.jpg')}}" alt="AVATAR">
                </div>

                <span class="login100-form-title p-t-20 p-b-45">
						John Doe
					</span>
                @if($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x
                        </button>
                    {{$message}}
                    </div>
                @endif
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
                    <input class="input100 form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Masukan emai" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                    <input class="input100 form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
                </div>

                <div class="container-login100-form-btn p-t-10">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="{{asset('assets/AssetsLoginForm/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/AssetsLoginForm/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('assets/AssetsLoginForm/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/AssetsLoginForm/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/AssetsLoginForm/js/main.js')}}"></script>

</body>
</html>