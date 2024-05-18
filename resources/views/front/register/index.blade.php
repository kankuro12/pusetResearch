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
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="savepassword">
                                    <div class="left">
                                        <input type="checkbox" name="agree" id="agree">
                                        <div class="text">
                                            Yes, I agree to have my data collected and stored according to the information.
                                        </div>

                                    </div>
                                </div>
                                <button type="submit">
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

@endsection
