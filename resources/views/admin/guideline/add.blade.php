@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.guideline.index') }}">guideline</a>
    <a href="{{ route('admin.guideline.add') }}">Add</a>
@endsection
@section('active', 'guideline')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.guideline.add') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" id="description" class="form-control note" required></textarea>
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
@section('js')
@endsection
