@extends('front.layout.app')

@section('top_name')
    Login
@endsection

@section('header_link')
    <a href="{{ route('client.login') }}">Login</a>
@endsection

@section('content')
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="heading">
                        <h3>Login Now</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('client.login') }}" method="POST">
                        @csrf
                        <div class="inputs">
                            <div class="form-group mb-4">
                                <input type="text" name="email" id="email" placeholder="Email" class="form-control" value="{{ old('username') }}">
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                {!! app('captcha')->display(['data-callback' => 'onRecaptchaSuccess', 'data-expired-callback' => 'onRecaptchaExpired', 'data-error-callback' => 'onRecaptchaError']) !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="savepassword">
                            <div class="left">
                                <input type="checkbox" name="remember" id="remember">
                                <div class="text">Keep me logged in</div>
                            </div>
                            <div class="right">
                                <a href="#">Forget Password</a>
                            </div>
                        </div>
                        <div>
                            <button type="submit" id="loginBtn" disabled style="opacity: 0.6; cursor: not-allowed;">
                                Login
                            </button>
                            <div class="register-link">
                                Don't have an account? <a href="{{ route('register') }}">Register</a><br>
                                <small>Need to verify your email? <a href="{{ route('email.resend.form') }}">Resend verification email</a></small>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {!! app('captcha')->renderJs() !!}
    <script>
        // Debug: Check if functions are loaded
        console.log('reCAPTCHA callback functions loaded');

        function enableLoginButton() {
            console.log('Enabling login button');
            const loginBtn = document.getElementById('loginBtn');
            if (loginBtn) {
                loginBtn.disabled = false;
                loginBtn.style.opacity = '1';
                loginBtn.style.cursor = 'pointer';
            }
        }

        function disableLoginButton() {
            console.log('Disabling login button');
            const loginBtn = document.getElementById('loginBtn');
            if (loginBtn) {
                loginBtn.disabled = true;
                loginBtn.style.opacity = '0.6';
                loginBtn.style.cursor = 'not-allowed';
            }
        }

        // reCAPTCHA callback functions - these must be in global scope
        window.onRecaptchaSuccess = function(response) {
            console.log('reCAPTCHA Success:', response);
            enableLoginButton();
        };

        window.onRecaptchaExpired = function() {
            console.log('reCAPTCHA Expired');
            disableLoginButton();
        };

        window.onRecaptchaError = function() {
            console.log('reCAPTCHA Error');
            disableLoginButton();
        };
    </script>
@endsection
