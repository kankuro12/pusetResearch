<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('asset/client/index.css') }}">
</head>

<body>
    <div class="navigation">
        <div class="left">
            <div class="name">
                <a href="">
                    Name
                </a>
            </div>
        </div>
        <div class="right">
            <div class="homepage">
                <a href="{{ route('index') }}">
                    <i class="fa-solid fa-eye"></i>
                    view site
                </a>
            </div>
            <div class="profile">
                <i class="fa-solid fa-user"></i>
                username
            </div>
        </div>

    </div>
    <div class="row m-0">
        <div class="col-md-2 p-0">
            @include('client.sidebar')
        </div>
        <di class="col-md-10 p-0">
            <div class="top" style="background-color: #DDDDDD">
                <h1>
                    Heading
                </h1>
            </div>
            <div class="middle">
                <div class="tablist">
                    <div class="left">
                        <div class="queue">
                            <a href="#">
                                My Queue
                            </a>
                        </div>
                        <div class="issue">
                            <a href="#">
                                Issue
                            </a>
                        </div>
                    </div>
                    <div class="right">
                        <div class="help">
                            <a href="">
                                <i class="fa-solid fa-headset"></i> Help
                            </a>
                        </div>
                    </div>

                </div>
                <div class="panel" style="padding: 30px 250px 30px 30px">
                    <div class="content" style="background-color: #DDDDDD">
                        <div class="title">
                            Title
                        </div>
                        <div class="search">
                            Search
                        </div>
                    </div>

                </div>
            </div>
            <div class="bottom">

            </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>

</html>
