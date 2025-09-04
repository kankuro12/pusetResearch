@extends('front.layout.app')

@section('top_name')
    Register
@endsection

@section('header_link')
    <a href="{{ route('register') }}">Register</a>
@endsection

@section('content')
    <div class="register">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="registerForm" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="heading">
                                    <h4>Profile Info</h4>
                                </div>
                                <div class="inputs">
                                    <div class="form-group mb-4">
                                        <input type="text" name="name" id="name" placeholder="Name"
                                            class="form-control" value="{{ old('name') }}">

                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="affiliation" id="affiliation" placeholder="Affiliation"
                                            class="form-control" value="{{ old('affiliation') }}">

                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="country" id="country" placeholder="Country"
                                            class="form-control" value="{{ old('country') }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="heading">
                                    <h4>Login Info</h4>
                                </div>
                                <div class="inputs">
                                    <div class="form-group mb-4">
                                        <input type="email" name="email" id="email" placeholder="Email"
                                            class="form-control" value="{{ old('email') }}">

                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" name="password" id="password" placeholder="Password"
                                            class="form-control">

                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" name="password_confirmation" id="re_password"
                                            placeholder="Re-type Password" class="form-control">

                                    </div>
                                    <div class="form-group mb-4">
                                        {!! app('captcha')->display(['data-callback' => 'onRegisterRecaptchaSuccess', 'data-expired-callback' => 'onRegisterRecaptchaExpired', 'data-error-callback' => 'onRegisterRecaptchaError']) !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="savepassword">
                                    <div class="left">
                                        <input type="checkbox" name="agree" id="agree" required>
                                        <div class="text">
                                            Yes, I agree to have my data collected and stored according to the information.
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" id="registerBtn" disabled style="opacity: 0.6; cursor: not-allowed;">
                                    Register
                                </button>
                            </div>
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
        console.log('Register page reCAPTCHA callback functions loaded');

        function enableRegisterButton() {
            console.log('Enabling register button');
            const registerBtn = document.getElementById('registerBtn');
            if (registerBtn) {
                registerBtn.disabled = false;
                registerBtn.style.opacity = '1';
                registerBtn.style.cursor = 'pointer';
            }
        }

        function disableRegisterButton() {
            console.log('Disabling register button');
            const registerBtn = document.getElementById('registerBtn');
            if (registerBtn) {
                registerBtn.disabled = true;
                registerBtn.style.opacity = '0.6';
                registerBtn.style.cursor = 'not-allowed';
            }
        }

        // reCAPTCHA callback functions for register form - must be in global scope
        window.onRegisterRecaptchaSuccess = function(response) {
            console.log('Register reCAPTCHA Success:', response);
            enableRegisterButton();
        };

        window.onRegisterRecaptchaExpired = function() {
            console.log('Register reCAPTCHA Expired');
            disableRegisterButton();
        };

        window.onRegisterRecaptchaError = function() {
            console.log('Register reCAPTCHA Error');
            disableRegisterButton();
        };

        // Additional validation: Check if terms checkbox is checked
        document.addEventListener('DOMContentLoaded', function() {
            const agreeCheckbox = document.getElementById('agree');
            const registerBtn = document.getElementById('registerBtn');

            function checkFormValidity() {
                // Only enable if both reCAPTCHA is completed AND terms are agreed
                const recaptchaResponse = document.querySelector('#g-recaptcha-response');
                const isRecaptchaValid = recaptchaResponse && recaptchaResponse.value.length > 0;
                const isTermsAgreed = agreeCheckbox.checked;

                if (isRecaptchaValid && isTermsAgreed) {
                    enableRegisterButton();
                } else {
                    disableRegisterButton();
                }
            }

            // Listen for terms checkbox changes
            if (agreeCheckbox) {
                agreeCheckbox.addEventListener('change', checkFormValidity);
            }
        });
    </script>
@endsection
