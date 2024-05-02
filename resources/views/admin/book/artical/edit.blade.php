@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Book</a>
    <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}"> Book Artical</a>
    <a href="{{ route('admin.book.article.editArticle', ['book_id' => $book->id, 'article_id' => $artical->id]) }}">Edit</a>
@endsection
@section('active', 'book')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.book.article.editArticle', ['book_id' => $book->id, 'article_id' => $artical->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="artical_type_id">Select Artical Type</label>
                        <select name="artical_type_id" id="artical_type_id" class="form-control">
                            @foreach ($articalTypes as $item)
                                <option value="{{ $item->id }}" {{ $artical->artical_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$artical->title}}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="doi">DOI</label>
                    <input type="text" name="doi" id="doi" class="form-control" value="{{$artical->doi}}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" id="tags" class="form-control" value="{{$artical->tags}}">
                </div>
                <div class="col-md-9 mb-2">
                    <label for="abstract">Abstract</label>
                    <textarea type="text" name="abstract" id="abstract" class="form-control"> {{$artical->abstract}} </textarea>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="file">file</label>
                    <input type="file" name="file" id="file" class="form-control photo"accept=".pdf, .docx" data-default-file="{{vasset($artical->file)}}">
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
@section('js')
    <script>
        $(document).ready(function() {
            $('#artical_type_id').select2();
        });
    </script>
@endsection
