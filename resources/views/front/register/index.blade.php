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
                    <form action="{{route('register')}}" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="heading">
                                    <h4>
                                        Profile Info
                                    </h4>
                                </div>
                                <div class="inputs">
                                    <div class="form-group mb-4">
                                        <input type="text" name="name" id="name" placeholder="Name"
                                            class="form-control">
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="affiliation" id="affiliation" placeholder="affiliation"
                                            class="form-control">
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="country" id="country" placeholder="country"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="heading">
                                    <h4>
                                        Login Info
                                    </h4>
                                </div>
                                <div class="inputs">
                                    <div class="form-group mb-4">
                                        <input type="email" name="email" id="email" placeholder="Email"
                                            class="form-control">
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="password" id="password" placeholder="Password"
                                            class="form-control">
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="re_password" id="re_password"
                                            placeholder="Re-type Password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="savepassword">
                                    <div class="left">
                                        <input type="checkbox" name="remember" id="remember">
                                        <div class="text">
                                            Yes, I agree to have my data collected and stored according to the information.
                                         </div>
                                    </div>
                                </div>
                                <button>
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
