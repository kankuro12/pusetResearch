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
    <link rel="stylesheet" href="{{ asset('asset/front/css/login/index.css') }}">
    <title>Document</title>
    <style>

    </style>
</head>

<body>
    <div class="content">
        <header>
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
                                                            <a class="nav-link" href="#" id="aboutus_a">About
                                                                Us</a>
                                                        </li>
                                                        <li class="nav-item dropdown" id="dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#"
                                                                id="navbarDropdown" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Article
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                <li><a class="dropdown-item" href="#">Action</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item dropdown" id="dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#"
                                                                id="navbarDropdown" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Issue
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                <li><a class="dropdown-item" href="#">Action</a>
                                                                </li>
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li><a class="dropdown-item" href="#">Something
                                                                        else
                                                                        here</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item dropdown" id="dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#"
                                                                id="navbarDropdown" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Page
                                                            </a>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="navbarDropdown">
                                                                <li><a class="dropdown-item" href="#">Action</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#"
                                                                        id="login">Login</a></li>
                                                                <div class="side_menu">
                                                                    <ul>
                                                                        <li><a href="#">login</a></li>
                                                                        <li><a href="#">Register</a></li>
                                                                    </ul>
                                                                </div>
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li><a class="dropdown-item" href="#">Something
                                                                        else
                                                                        here</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    @yield('content')
                </div>
                <div class="col-md-2">
                    <div class="sidebar">

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <footer>
            <div class="container">
                <div class="footer-column">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="aboutus">
                                <div class="logo">
                                    <a href="#">
                                        <img src="{{ asset('asset/front/css/img/pngtree-creative-company-logo-png-image_1197025-removebg-preview.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="description mt-1">
                                    <p>
                                        Lorem ipsum dolor adipisofficifsdfa minus! Sed.... <a href="#">Read
                                            More</a>
                                    </p>
                                </div>
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
                                    <div class="rss-icon">
                                        <i class="fa fa-rss"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="getintouch">
                                <div class="head">
                                    <h5>Get In Touch</h5>
                                </div>
                                <div class="item">
                                    <ul>
                                        <li class="address">
                                            <i class="fa-solid fa-house"></i>
                                            <div class="item">
                                                sdasdfdfa
                                            </div>
                                        </li>
                                        <li><a href="tel:(+977)98000898">
                                                <i class="fa-solid fa-phone"></i>
                                                <div class="item">
                                                    (+977)98000898
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="tel:(+977)98080978">
                                                <i class="fa-solid fa-tablet-screen-button"></i>
                                                <div class="item">
                                                    (+977)98080978
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:test@gamil.com">
                                                <i class="fa-solid fa-envelope"></i>
                                                <div class="item">
                                                    test@gamil.com
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                More
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="resource">
                                <div class="head">
                                    <h5>Resource</h5>
                                </div>
                                <div class="item">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                Author
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                librarian
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                sponsers & Advertisers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Press & Media
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <p class="sj-copyrights">© 2015 <a href=""> Amentojourny</a>. All Rights Reserved</p>
                </div>

            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
