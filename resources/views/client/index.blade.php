@extends('client.layout.app')
@section('content')
    <div class="dashboard">
        <div class="mt-2 mx-0 mx-md-4 mt-md-4">
            <div class="row">
                <div class="col-md-4 ">
                    <a  href="{{route('client.submission.index')}}">
                        My Submissions
                    </a>
                </div>
                <div class="col-md-4  ">
                    <a  href="{{route('client.info.index')}}">
                        My Profile
                    </a>
                </div>
                <div class="col-md-4 ">
                    <a  href="{{route('client.info.password')}}">
                        Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
