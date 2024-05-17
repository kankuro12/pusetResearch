@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Issues</a>
    <a href="#">{{$book->title}}</a>
    <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}"> Articles</a>
    <a href="#">Add</a>
@endsection
@section('active', 'book')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.book.article.addArticle', ['book_id' => $book->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="book_id" value="{{$book->id}}">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="file">PDF File</label>
                        <input type="file" name="file" id="file" class="form-control photo" accept=".pdf" required>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="artical_type_id" class="mb-1">Article Type</label>
                            <select name="artical_type_id" id="artical_type_id" class="form-control" required>
                                @foreach ($articalTypes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12"></div>

                        <div class="col-md-8 mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="tags">Searchable Tags</label>
                            <input type="text" name="tags" id="tags" class="form-control">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="doi">DOI</label>
                            <input type="text" name="doi" id="doi" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="starting_page">Starting Page No</label>
                            <input type="number" name="starting_page" id="starting_page" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="ending_page">Ending Page No</label>
                            <input type="number" name="ending_page" id="ending_page" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="short_desc">Short Description</label>
                            <textarea type="text" name="short_desc" id="short_desc" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="abstract">Abstract</label>
                            <textarea type="text" name="abstract" id="abstract" class="form-control"></textarea>
                        </div>

                        <div class="col-md-12 mb-2 text-end">
                            <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}"
                                class="btn btn-danger btn-sm" onClick="return yes();">
                                Cancel
                            </a>
                            <button class="btn btn-primary btn-sm">
                                Save Data
                            </button>
                        </div>
                    </div>
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
