@extends('client.layout.app')
@section('header-link')
    <a href="#">My Profile</a>
    <a href="#">Change Password</a>
@endsection
@section('active', 'pass')
@section('content')
    <div class="shadow mt-2 p-3">
        <form action="{{ route('client.info.password') }}" onsubmit="validateData(this,event)" method="POST">
            @csrf
            <h5>
                Change Password
            </h5>
            <hr class="mt-0">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required  placeholder="Enter Current Password" />
                 </div>
                <div class="col-md-4 mb-2">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required placeholder="Enter New Password" >
                </div>
                <div class="col-md-4 mb-2">
                    <label for="new_password_confirmation">Retype Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required placeholder="Retype New Password"/>
                </div>
                <div class="col-md-4 mb-2 d-flex align-items-end">
                    <button class="btn btn-sm btn-primary">
                        Update Password
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection
@section('js')
    <script>
        function validateData(ele,e){
            if($('#new_password').val()!=$('#new_password_confirmation').val()){
                alert('Please confirm password');
                e.preventDefault();
            }
        }
    </script>
@endsection
