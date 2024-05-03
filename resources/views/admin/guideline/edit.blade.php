@extends('admin.layout.app')
@section('header-Links')
    <a href="{{route('admin.guideline.index')}}">guideline</a>
    <a href="{{route('admin.guideline.edit',['guideline_id'=>$guideline->id])}}">Edit</a>
@endsection
@section('active','guideline')
@section('content')
 <div class="shadow mt-3 p-3 bg-white rounded">
    <form action="{{route('admin.guideline.edit',['guideline_id'=>$guideline->id])}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{$guideline->title}}" class="form-control">
            </div>
            <div class="col-md-12 mb-2">
                <label for="description">Desription</label>
                <textarea type="text" name="description" id="description" class="form-control note">{{$guideline->description}}</textarea>
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
