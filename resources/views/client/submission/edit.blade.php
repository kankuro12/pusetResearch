@extends('client.layout.app')
@section('header-link')
    <a href="{{ route('client.submission.index') }}">Submissions</a>
    <a href="{{ route('client.submission.edit', ['sub_id' => $submission->id]) }}">Edit</a>
@endsection
@section('active', 'submission')

@section('content')
    <div class="shadow mt-3 p-3 bg-white">
        <form action="{{ route('client.submission.edit', ['sub_id' => $submission->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row mb-2">
                <div class="col-md-4 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ $submission->title }}">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"> {{ $submission->description }} </textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" data-default-file="{{ vasset($submission->file) }}"
                        accept=".pdf, .docx" class="form-control photo">
                </div>
                <div class="col-md-12 mb-2 text-start">
                    <button class="btn btn-primary btn-sm">
                        update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
