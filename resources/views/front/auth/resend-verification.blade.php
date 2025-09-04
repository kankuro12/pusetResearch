@extends('front.layout.app')

@section('top_name')
    Resend Verification Email
@endsection

@section('header_link')
    <a href="{{ route('email.resend.form') }}">Resend Verification</a>
@endsection

@section('content')
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="heading">
                        <h3>Resend Verification Email</h3>
                        <p class="text-muted">Enter your email address to receive a new verification link</p>
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

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('email.resend') }}" method="POST">
                        @csrf
                        <div class="inputs">
                            <div class="form-group mb-4">
                                <input type="email" name="email" id="email" placeholder="Enter your email address" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group mb-4">
                                {!! app('captcha')->display([
                                    'data-callback' => 'onResendRecaptchaSuccess',
                                    'data-expired-callback' => 'onResendRecaptchaExpired',
                                    'data-error-callback' => 'onResendRecaptchaError'
                                ]) !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" id="resendBtn" disabled style="opacity: 0.6; cursor: not-allowed;">
                            Resend Verification Email
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('front.login') }}">Back to Login</a>
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
        function enableResendButton() {
            console.log('Enabling resend button');
            const resendBtn = document.getElementById('resendBtn');
            if (resendBtn) {
                resendBtn.disabled = false;
                resendBtn.style.opacity = '1';
                resendBtn.style.cursor = 'pointer';
            }
        }

        function disableResendButton() {
            console.log('Disabling resend button');
            const resendBtn = document.getElementById('resendBtn');
            if (resendBtn) {
                resendBtn.disabled = true;
                resendBtn.style.opacity = '0.6';
                resendBtn.style.cursor = 'not-allowed';
            }
        }

        // reCAPTCHA callbacks for resend form
        window.onResendRecaptchaSuccess = function(response) {
            console.log('Resend reCAPTCHA Success:', response);
            enableResendButton();
        };

        window.onResendRecaptchaExpired = function() {
            console.log('Resend reCAPTCHA Expired');
            disableResendButton();
        };

        window.onResendRecaptchaError = function() {
            console.log('Resend reCAPTCHA Error');
            disableResendButton();
        };
    </script>
@endsection
