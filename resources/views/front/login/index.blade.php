@extends('front.layout.app')
@section('top_name')
Login
@endsection
@section('header_link')
<a href="">
    Login
</a>
@endsection
@section('content')
<div class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="heading">
                    <h3>
                        Login Now
                    </h3>
                </div>
                <form action="{{route('client.login')}}" method="POST" >
                    @csrf
                    <div class="inputs">
                        <div class="form-group mb-4">
                            <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" name="password" id="password" placeholder="Password" class="form-control">
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
                    <button >
                        login
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
