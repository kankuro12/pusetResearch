<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
        .login-form {
            padding: 20px;
            /* border: 1px solid #ADADAD; */
            border-radius: 5px;
        }

        .login-form h2 {
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            margin-bottom: 5px;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            border-radius: 25px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px 25px;
            font-size: inherit;
        }



        .login-form a {
            text-decoration: none;
        }

        .login-form p {
            margin-top: 20px;
        }

        .login-form button {
            margin-top: 10px;
        }

        body {
            background-color: #F8FAF9;
        }

        .form-control {
            padding: 12px 25px;
            height: auto;
            border: 2px solid #e8e8e8;
            font-weight: 400;

        }

        .btn.btn-primary {
            color: #fff;
            background: linear-gradient(90deg, #55c3b7 0, #5fd0a5 48%, #66da90 100%);
        }

        a {
            text-decoration: none;
            color: #62D59A;
        }

        .auth-options {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-control-label {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <div class="login-form">
                    <h2 class="text-center mb-4" style="color: #3F3F3F;">Welcome to login page</h2>
                    <p class="text-center mb-4" style="color: #3F3F3F;">Log in to continue.</p>
                    <form action="{{ Route('login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-submit"
                                style="border: none; height: auto;">Login</button>
                        </div>

                        <div class="auth-options mt-2"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="custom-control custom-checkbox form-group d-flex" style="align-items: center;">
                                <input name="me" type="checkbox" class="custom-control-input"
                                    style="margin-right: 5px;">
                                <label class="custom-control-label" for="exampleCheck1">Remember me</label>
                            </div>
                            <a href="#" class="forgot-link">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
