@extends('client.layout.app')
@section('header-link')
    <a href="{{ route('client.submission.index') }}">Submissions</a>
    <a href="#">Edit</a>
@endsection
@section('active', 'submission')

@section('content')
<div class="shadow mt-3 p-3 bg-white">
        @if($submission->status<2)
        <form action="{{ route('client.submission.edit', ['id' => $submission->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3 mb-2">
                    <label for="file">Attachment</label>
                    <input type="file" name="file" id="file" data-default-file="{{ route("client.file",['id'=>$submission->file_id]) }}"
                        accept=".pdf, .docx,.doc"  class="form-control photo">
                </div>
                <div class="col-md-9">
                    <div class=" mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $submission->title }}" required>
                    </div>
                    <div class=" mb-2">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ $submission->description }}</textarea>
                    </div>

                    <div class="mb-2 text-end">
                        <button class="btn btn-primary btn-sm">
                            Update Submission
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @else
        <h5 class="text-danger">
            The document {{submissionStatusMsg()[$submission->status]}} and cannot be edited.
        </h5>
        @endif
    </div>
@endsection
