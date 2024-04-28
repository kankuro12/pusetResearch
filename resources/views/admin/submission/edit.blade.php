@extends('admin.layout.app')

@section('header-Links')
    <a href="{{ route('admin.submission.index') }}">Submissions</a>
    <a href="{{ route('admin.submission.edit', ['sub_id' => $submission->id]) }}">Edit </a>
@endsection

@section('active', 'submission')

@section('content')
    <div class="shadow mt-3 p-3 bg-white">
        <form action="{{ route('admin.submission.edit', ['sub_id' => $submission->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row mb-2">
                <div class="col-md-3 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$submission->title}}">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"> {{$submission->description}} </textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" data-default-file="{{vasset($submission->file)}}" accept=".pdf, .docx" class="form-control photo">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$submission->status == 0 ? 'selected' : ''}}>Pending</option>
                        <option value="1" {{$submission->status == 1 ? 'selected' : ''}}>View</option>
                        <option value="2" {{$submission->status == 2 ? 'selected' : ''}}>Acceptance</option>
                        <option value="3" {{$submission->status == 3 ? 'selected' : ''}}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-12 mb-2 text-start">
                    <button class="btn btn-primary">
                        update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
