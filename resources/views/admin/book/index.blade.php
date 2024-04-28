@extends('admin.layout.app')
@section('header-Links')
    <a href="{{route('admin.book.index')}}">Book</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.book.add')}}" class="btn btn-primary">Add</a>
@endsection
@section('active','book')
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white rounded">
        <div class="table-responsive">
            <table class="table table-bordered" id="books">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Issn</th>
                        <th>DOI</th>
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
                columns: [{
                        data: 'title'
                    },
                    {
                        data: 'issn'
                    },
                    {
                        data: 'doi'
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
            return '<a href="' + editURL.replace('xxx_id', id) + '" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +
                '" class="btn btn-sm btn-danger">Delete</a>';
        }
    </script>
@endsection
