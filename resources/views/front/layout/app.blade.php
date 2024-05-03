<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('asset/front/css/index.css') }}">
    <title>Document</title>
    <style>

    </style>
</head>

<body>
    <div class="main-container rounded">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="topbar">
                        <div class="social-icons">
                            <div class="facebook-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="twitter-icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="linkedin-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                            <div class="google-icon">
                                <i class="fab fa-google-plus-g"></i>
                            </div>
                        </div>

                        <div class="logins">
                            <div class="login-area">
                                <div class="login">
                                    <a href="#">Login</a>
                                </div>
                                <div class="register">
                                    <a href="#">Register</a>
                                </div>
                            </div>
                            <div class="language">

                            </div>
                        </div>
                    </div>
                    <hr style="margin-bottom: 15px">
                    <div class="navigation">
                        <div class="row">
                            <div class="col-md-4 col-4">
                                <div class="logo">
                                    <a href="#">
                                        Logo
                                        <img src="#" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="headers">
                                    <nav class="navbar navbar-expand-lg ">
                                        <div class="container-fluid">
                                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#navbarSupportedContent"
                                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                                aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                            </button>
                                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                    <li class="nav-item" id="aboutus">
                                                        <a class="nav-link" href="#">About Us</a>
                                                    </li>
                                                    <li class="nav-item dropdown" id="dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#"
                                                            id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Article
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item dropdown" id="dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#"
                                                            id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Issue
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">Something else
                                                                    here</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item dropdown" id="dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#"
                                                            id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Page
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li><a class="dropdown-item" href="#">Action</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">Another
                                                                    action</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">Something else
                                                                    here</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <form class="d-flex">
                                                    <input class="form-control me-2" type="search"
                                                        aria-label="Search">
                                                    <button class="btn btn-outline-success"
                                                        type="submit">Search</button>
                                                </form>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="books">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bookimage">
                                    <a href="#">
                                        <img src="{{asset('asset/front/css/img/4828957-removebg-preview.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner">
                                    <h1 style="color: #636C77">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    </h1>
                                    <div class="description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod at fuga voluptates sit cum. Hic in tempora, nulla laborum numquam nostrum officia rem voluptatum omnis atque quod unde odio harum.... <a href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>

</html>
