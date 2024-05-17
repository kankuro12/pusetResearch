<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('asset/back/plugins/drophify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/back/css/index.css') }}">
    <title>{{config('app.name')}}</title>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
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
