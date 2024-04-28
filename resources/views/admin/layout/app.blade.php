<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/back/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/back/plugins/drophify/css/dropify.min.css') }}">
    <title>Document</title>
    <style>
        body {
            background: #F9FAFD;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .dashboard-link a:not(:last-child)::after {
            content: '/';
            margin: 0px 3px;
        }

        .dashboard-link a {
            color: rgb(81, 81, 81);
            text-decoration: none;
            font-weight: 600;
        }

        .dashboard-link a:hover {
            color: #007ACC
        }

        .btn {
            border-radius: 4px !important;
            min-width: 50px;
        }

        #sidebar {
            background: #313A46;
            min-height: 100vh;
            height: 100%;
        }

        .nav {
            background: #313A46;
        }

        .nav .nav-item .nav-link {
            color: rgb(192, 192, 192);
            transition: all 1s;
            font-size: 15px;
            padding: 10px 10px 10px 20px;
        }

        .nav .nav-item .nav-link:hover,
        .nav .nav-item .nav-link.active {
            color: white;
            background: #3A4F6A;
        }

        .nav .nav-item .nav-link.active {
            transform: scale(1.05)
        }

        .btn-primary {
            background: #727CF5;
            border: #727cf5 1px solid;

        }

        .btn-primary:hover {
            background: #727CF5;
        }

        #head-title {
            color: white;
        }

        .tool-bar .btn {
            min-width: 100px;
        }

        .br-3 {
            border-radius: 5px;
        }

        @import url("https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap");

        * {
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="row m-0">
        <div class="col-md-2 p-0">
            @include('admin.sidebar')
        </div>
        <div class="col-md-10 p-0">
            <div class="d-flex shadow bg-white align-items-center py-3 px-3 justify-content-between">
                <div class="dashboard-link">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                    @yield('header-Links')
                </div>
                <div class="tool-bar">
                    @yield('toolbar')
                </div>
            </div>
            <div class="p-3">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js"
        integrity="sha512-NQfB/bDaB8kaSXF8E77JjhHG5PM6XVRxvHzkZiwl3ddWCEPBa23T76MuWSwAJdMGJnmQqM0VeY9kFszsrBEFrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('asset/back/plugins/drophify/js/dropify.min.js') }}"></script>
    @include('admin.layout.jshelper')
    @yield('js')
    <script>
        $(document).ready(function() {
            $('.photo').dropify();
            $('.note').summernote({
                tabsize: 2,
                height: 200,
            });
            $('#@yield('active')').addClass('active');
            $('.tool-bar .btn').addClass('btn-sm');
        });
    </script>
</body>

</html>
