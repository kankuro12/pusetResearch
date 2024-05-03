@extends('admin.layout.app')

@section('header-Links')
<a href="{{route('admin.team.index')}}">Team</a>
    <a href="{{ route('admin.team.team_member.index', ['team_id' => $team->id]) }}">Team Member</a>
    <a
        href="{{ route('admin.team.team_member.edit', ['team_member_id' => $team_member->id, 'team_id' => $team->id]) }}">Edit</a>
@endsection

@section('active', 'team_member')

@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form
            action="{{ route('admin.team.team_member.edit', ['team_member_id' => $team_member->id, 'team_id' => $team->id]) }}"
            method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $team_member->name }}" class="form-control">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" id="designation" value="{{ $team_member->designation }}"
                        class="form-control">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="team_designation">Team Designation</label>
                    <input type="text" name="team_designation" id="team_designation"
                        value="{{ $team_member->team_designation }}" class="form-control">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" id="organization" value="{{ $team_member->organization }}"
                        class="form-control">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="{{ $team_member->address }}"
                        class="form-control">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ $team_member->email }}"
                        class="form-control" required>
                </div>
                <div class="col-md-3 mb-2">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ $team_member->phone }}"
                        class="form-control">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="detail">Detail</label>
                    <input type="text" name="detail" id="detail" value="{{ $team_member->detail }}"
                        class="form-control">
                </div>
                <div class="col-md-12 mb-2 text-start">
                    <button class="btn btn-primary btn-sm">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
