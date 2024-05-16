@extends('admin.layout.app')
@section('header-Links')
    <a href="{{route('admin.team.index')}}">Teams</a>
    <a href="{{route('admin.team.add')}}">Add</a>
@endsection
@section('active','team')
@section('content')
 <div class="shadow mt-3 p-3 bg-white rounded">
    <form action="{{route('admin.team.add')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="col-md-12 mb-2">
                <label for="desc">Desription</label>
                <textarea type="text" name="desc" id="desc" class="form-control"></textarea>
            </div>
            <div class="col-md-12 mb-2 text-start">
                <button class="btn btn-primary btn-sm">
                    Add
                </button>
            </div>
        </div>
    </form>
 </div>
@endsection
