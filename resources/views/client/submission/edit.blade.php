@extends('client.layout.app')
@section('header-link')
    <a href="{{ route('client.submission.index') }}">Submissions</a>
    <a href="{{ route('client.submission.edit', ['sub_id' => $submission->id]) }}">Add</a>
@endsection
@section('content')
    <div class="shadow mt-3 p-3 bg-white">
        <form action="{{ route('client.submission.edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-2">
                <div class="col-md-3 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="0">Pending</option>
                        <option value="1">View</option>
                        <option value="2">Acceptance</option>
                        <option value="3">Rejected</option>
                    </select>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" class="form-control photo" accept=".pdf, .docx">
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
