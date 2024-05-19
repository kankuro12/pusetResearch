@extends('client.layout.app')
@section('header-link')
    <a href="#">My Profile</a>
@endsection
@section('active', 'profile')
@section('content')
    <div class="shadow mt-2 p-3">
        <form action="{{ route('client.info.index') }}" method="POST">
            @csrf
            <h5>
                My Info
            </h5>
            <hr class="mt-0">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control" value="{{ $client->country }}">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="affiliation">Affiliation</label>
                    <input type="text" name="affiliation" id="affiliation" class="form-control"
                        value="{{ $client->affiliation }}">
                </div>
                <div class="col-md-12  text-end mb-2">
                    <button class="btn btn-sm btn-primary">
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
