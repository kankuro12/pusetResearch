@extends('admin.layout.app')
@section('header-Links')
    <a href="{{route('admin.team.index')}}">Team</a>
    <a href="{{route('admin.team.edit',['team_id'=>$team->id])}}">Edit</a>
@endsection
@section('active','team')
@section('content')
 <div class="shadow mt-3 p-3 bg-white rounded">
    <form action="{{route('admin.team.edit',['team_id'=>$team->id])}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{$team->title}}" class="form-control">
            </div>
            <div class="col-md-12 mb-2">
                <label for="desc">Desription</label>
                <textarea type="text" name="desc" id="desc" class="form-control">{{$team->desc}}</textarea>
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
