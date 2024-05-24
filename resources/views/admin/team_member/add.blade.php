@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.team.index') }}">Teams</a>
    <a href="#">{{ ucwords($team->title)}}</a>
    <a href="{{ route('admin.team.team_member.index', ['team_id' => $team->id]) }}">Members</a>
    <a href="#">Add</a>
@endsection
@section('active', 'team_member')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.team.team_member.add',['team_id'=>$team->id]) }}" method="POST">
            @csrf
            <div class="row" style="align-items: flex-end">
                <div class="col-md-3 mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required >
                </div>
                <div class="col-md-3 mb-2">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" id="designation" class="form-control" required >
                </div>
                <div class="col-md-6 mb-2">
                    <label for="team_designation">Team Designation</label>
                    <input type="text" name="team_designation" id="team_designation" class="form-control" required>
                </div>
                <div class="col-md-3 mb-2">
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" id="organization" class="form-control" required >
                </div>
                <div class="col-md-3 mb-2">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required >
                </div>
                <div class="col-md-3 mb-2">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" id="phone" class="form-control" required >
                </div>
                <div class="col-md-3 mb-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required >
                </div>
                <div class="col-md-8 mb-2">
                    <label for="detail">Detail</label>
                    <input type="text" name="detail" id="detail" class="form-control" required >
                </div>
                <div class="col-md-4 mb-2 text-start d-flex align-items-end py-1">
                    <button class="btn btn-primary btn-sm">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
