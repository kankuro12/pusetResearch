@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Issues</a>
    <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}">Articles</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.book.article.addArticle', ['book_id' => $book->id]) }}" class="btn btn-primary btn-sm">Add</a>
@endsection
@section('active', 'book')
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white rounded">
        <div class="table-responsive">
            <table class="table table-bordered" id="articles">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artical Type</th>
                        <th>DOI</th>
                        <th>Tags</th>
                        <th>Abstract</th>
                        <th>manage</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.layout.datatable')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#articles').DataTable({
                columnDefs: [{
                        targets: [0, 1],
                        searchable: true
                    },
                    {
                        targets: [2, 3, 4],
                        searchable: false
                    },
                    {
                        targets: [5],
                        orderable: false
                    }
                ],
                ajax: {
                    url: "{{ route('admin.book.article.listArticle') }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'title'
                    },
                    {
                        data: 'artical_type_name'
                    },
                    {
                        data: 'doi'
                    },
                    {
                        data: 'tags'
                    },
                    {
                        data: 'abstract',
                        className: 'text-end'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            console.log(data);
                            return getUrls(data.id, data.book_id);
                        }
                    }
                ],
            })
        });

        function getUrls(id, book_id) {
            const editURL = "{{ route('admin.book.article.editArticle', ['book_id' => 'xxx_id', 'article_id' => 'xyz']) }}";
            const delURL = "{{ route('admin.book.article.delArticle', ['article_id' => 'xxx_id']) }}";
            const authorURL = "{{ route('admin.book.article.articleAuthor.indexAuthor', ['book_id' => 'xxx_id', 'article_id' => 'abc']) }}";

            return '<a href="' + editURL.replace('xxx_id', book_id).replace('xyz', id) +'" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +'" class="btn btn-sm btn-danger">Delete</a> ' +
                '<a href="' + authorURL.replace('xxx_id', book_id).replace('abc', id) +'" class="btn btn-sm btn-success"> Manage Author</a> ';
        }
    </script>
@endsection
