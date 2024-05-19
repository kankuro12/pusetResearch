@extends('client.layout.app')
@section('header-link')
@endsection
@section('active','profile')
@section('content')
    <div class="shadow mt-2 p-3">
        <form action="{{ route('client.info.index') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <h5>
                        General info
                    </h5>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $client->name }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-control"
                                value="{{ $client->country }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="affiliation">affiliation</label>
                            <input type="text" name="affiliation" id="affiliation" class="form-control"
                                value="{{ $client->affiliation }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5>
                        Change Password
                    </h5>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" >
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-sm btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
