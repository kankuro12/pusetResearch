@extends('admin.layout.app')
@section('active','message')
@section('toolbar')
@endsection
@section('header-Links')
<a href="{{route('admin.message.index')}}">Messages</a>
<a href="#">Add</a>
@endsection
@section('content')

    <div class="bg-white mt-3 p-3">
        <form action="{{route('admin.message.add')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="file" name="image" accept="image/*" id="image" class="photo form-control" required>
                </div>
                <div class="col-md-8">
                    <div class="mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="desc">message</label>
                        <textarea type="text" name="desc" id="desc" class="form-control note" required></textarea>
                    </div>
                    <div class="text-end">
                        <a class="btn btn-danger" href="{{route('admin.message.index')}}">cancel</a>
                        <button class="btn btn-primary">Add Message</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')



@endsection
