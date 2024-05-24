@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Issues</a>
    <a href="#">{{$book->title}}</a>
    <a href="#">Edit</a>
@endsection
@section('active', 'book')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.book.edit', ['book_id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-2">
                    <div class=" mb-2">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control photo"
                            data-default-file="{{ asset($book->image) }}" accept="image/jpeg, image/png,image/png" required>
                    </div>
                    <div class="mb-2">
                        <label for="file">file</label>
                        <input type="file" name="file" id="file" class="form-control photo"
                            data-default-file="{{ vasset($book->file) }}" accept=".pdf, .docx" required>
                    </div>
                </div>
                <div class="col-md-9 mb-2">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" value="{{ $book->title }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="eng_title">English Title</label>
                            <input type="text" name="eng_title" id="eng_title" value="{{ $book->eng_title }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="issn">Issn</label>
                            <input type="number" name="issn" id="issn" value="{{ $book->issn }}" class="form-control" required>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="doi">DOI</label>
                            <input type="text" name="doi" id="doi" value="{{ $book->doi }}" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="issue_name">Issue name</label>
                            <input type="text" name="issue_name" id="issue_name" value="{{ $book->issue_name }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="volume">Volume</label>
                            <input type="text" name="volume" id="volume" value="{{ $book->volume }}" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="language_of_publication">Language Of Publication</label>
                            <input type="text" name="language_of_publication" value="{{ $book->language_of_publication }}"
                                id="language_of_publication" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="issue">Issue Date</label>
                            <input type="date" name="issue" id="issue" value="{{ $book->issue }}" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="published_date">Published Date</label>
                            <input type="date" name="published_date" id="published_date" value="{{ $book->published_date }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-2" style="align-content: center">
                            <label for="iscurrent">Iscurrent</label>
                            <input type="checkbox" class="ms-2" name="iscurrent" id="iscurrent" {{ $book->iscurrent ? 'checked' : '' }}>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="s_description">Short Description</label>
                            <textarea type="text" name="s_description" id="s_description" rows="3" class="form-control" required>{{ $book->s_description }}"</textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" id="description" class="form-control" required>{{ $book->description }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 mb-2 text-end">
                    <a class="btn btn-danger btn-sm" href="{{route('admin.book.index')}}" onclick="return yes();">
                        Cancel
                    </a>
                    <button class="btn btn-primary btn-sm">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('book').addEventListener('submit', function(event) {
                var isCurrentCheckbox = document.getElementById('iscurrent');
                if (!isCurrentCheckbox.checked) {
                    return false;
                }
                return true;
            });
        });
    </script>
@endsection
