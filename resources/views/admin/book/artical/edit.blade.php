@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Issues</a>
    <a href="#">{{$book->title}}</a>
    <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}">Articles</a>
    <a href="#">Edit</a>
@endsection
@section('toolbar')
<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Author
</button>
@endsection
@section('active', 'book')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.book.article.editArticle', ['book_id' => $book->id, 'article_id' => $artical->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="file">PDF File</label>
                        <input type="file" name="file" id="file" class="form-control photo"accept=".pdf, .docx"
                            data-default-file="{{ vasset($artical->file) }}" required>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="artical_type_id">Select Artical Type</label>
                            <select name="artical_type_id" id="artical_type_id" class="form-control" required>
                                @foreach ($articalTypes as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $artical->artical_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-8 mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $artical->title }}" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="tags"> Searchable Tags</label>
                            <input type="text" name="tags" id="tags" class="form-control"
                                value="{{ $artical->tags }}" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="doi">DOI</label>
                            <input type="text" name="doi" id="doi" class="form-control"
                                value="{{ $artical->doi }}" required>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="starting_page">Starting Page No</label>
                            <input type="number" name="starting_page" id="starting_page" class="form-control"
                                value="{{ $artical->st_page_no }}" required oninput="valueCheck()">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="ending_page">Ending Page No</label>
                            <input type="number" name="ending_page" id="ending_page" class="form-control"
                                value="{{ $artical->en_page_no }}" required oninput="valueCheck()">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="abstract">Abstract</label>
                            <textarea type="text" name="abstract" id="abstract" class="form-control"> {{ $artical->abstract }} </textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2 text-start">
                    <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}"
                        class="btn btn-danger btn-sm" onClick="return yes();">
                        Cancel
                    </a>
                    <button class="btn btn-primary btn-sm">
                        update
                    </button>
                </div>
            </div>
        </form>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 700px">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="author-name" id="author-name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="link">Link</label>
                                <input type="text" name="author-link" id="author-link" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="designation">Designation</label>
                                <input type="text" name="author-designation" id="author-designation"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="organization">Organization</label>
                                <input type="text" name="author-organization" id="author-organization"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveNewAuthor()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        function valueCheck() {
            var st_page = $('#starting_page').val();
            var end_page = $('#ending_page').val();
            if (st_page && end_page > 0) {
                if (st_page > end_page) {
                    error('The starting page should be smaller than ending page');
                }
            }

        }
        $(document).ready(function() {
            $('#artical_type_id').select2();
        });

        function saveNewAuthor() {
            var name = $('#author-name').val();
            var link = $('#author-link').val();
            var designation = $('#author-designation').val();
            var organization = $('#author-organization').val();

            const data = {
                name: name,
                link: link,
                designation: designation,
                organization: organization,
                "_token": "{{ csrf_token() }}"
            };
            const url = `{{ route('admin.author.add') }}`;
            axios.post(url, data)
                .then(res => {
                    success('Author successfully added');
                    location.reload();
                })
                .catch(err => {
                    error('Error adding author:', err);
                });
        }
    </script>
@endsection
