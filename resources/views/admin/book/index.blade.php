@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Issues</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.book.add') }}" class="btn btn-primary btn-sm">Add</a>
@endsection
@section('active', 'book')
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white rounded">
        <div class="table-responsive">
            <table class="table table-bordered" id="books">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Volume</th>
                        <th>Issue</th>
                        <th>Issue Date</th>
                        <th>Published Date</th>
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
            table = $('#books').DataTable({
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
                    url: "{{ route('admin.book.list') }}",
                    dataSrc: ''
                },
                columns: [
                    {
                        data: null,
                        render: function(data, type, row) {
                            console.log(data);
                            return `${data.title} ${data.iscurrent?"(Current)":``}`;
                        }
                    },
                    {
                        data: 'volume'
                    },
                    {
                        data: 'issue_name'
                    },
                    {
                        data: 'issue'
                    },
                    {
                        data: 'published_date',
                        className: 'text-end'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return getUrls(data.id);
                        }
                    }
                ],
            })
        });

        function getUrls(id) {
            const editURL = "{{ route('admin.book.edit', ['book_id' => 'xxx_id']) }}";
            const delURL = "{{ route('admin.book.del', ['book_id' => 'xxx_id']) }}";
            const ArticalURL = "{{ route('admin.book.article.indexArticle', ['book_id' => 'abc_id']) }}";
            return '<a href="' + editURL.replace('xxx_id', id) + '" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +
                '" class="btn btn-sm btn-danger">Delete</a> ' +
                '<a href="' + ArticalURL.replace('abc_id', id) + '" class="btn btn-sm btn-success">Articles</a>';
        }
    </script>
@endsection
