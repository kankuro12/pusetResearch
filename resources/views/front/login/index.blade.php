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
                                {!! app('captcha')->display() !!}
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
                        <button type="submit">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {!! app('captcha')->renderJs() !!}
@endsection
