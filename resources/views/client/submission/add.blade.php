@extends('client.layout.app')
@section('header-link')
    <a href="{{ route('client.submission.index') }}">Submissions</a>
    <a href="{{ route('client.submission.add') }}">Add</a>
@endsection
@section('active', 'submission')
@section('content')
    <div class="shadow mt-3 p-3 bg-white">
        <form action="{{ route('client.submission.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-2">
                <div class="col-md-4 mb-2">
                    <label for="file">PDF FILE</label>
                    <input type="file" name="file" id="file" class="form-control photo" accept=".pdf, .docx">
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-2 text-start">
                        <button class="btn btn-primary btn-sm">
                            Add
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
