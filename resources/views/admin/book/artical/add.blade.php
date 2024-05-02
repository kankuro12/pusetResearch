@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Book</a>
    <a href="{{ route('admin.book.artical.indexArtical', ['book_id' => $book->id]) }}"> Book Artical</a>
    <a href="{{ route('admin.book.artical.addArtical', ['book_id' => $book->id]) }}">Add</a>
@endsection
@section('active', 'book')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.book.artical.addArtical', ['book_id' => $book->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="artical_type_id">Select Artical Type</label>
                        <select name="artical_type_id" id="artical_type_id" class="form-control">
                            @foreach ($articalTypes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="doi">DOI</label>
                    <input type="text" name="doi" id="doi" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" id="tags" class="form-control">
                </div>
                <div class="col-md-9 mb-2">
                    <label for="abstract">Abstract</label>
                    <textarea type="text" name="abstract" id="abstract" class="form-control"></textarea>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="file">file</label>
                    <input type="file" name="file" id="file" class="form-control photo"accept=".pdf, .docx">
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
    <script>
        $(document).ready(function() {
            $('#artical_type_id').select2();
        });
    </script>
@endsection

