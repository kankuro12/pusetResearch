@extends('admin.layout.app')
@section('header-Links')
    <a href="{{route('admin.submission.index')}}">Submission</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.submission.add')}}" class="btn btn-primary">Add</a>
@endsection
@section('active','submission')
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white">
        <div class="table-responsive">
            <table class="table table-bordered" id="submissions">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
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
            table = $('#submissions').DataTable({
                columnDefs: [{
                        targets: [0, 1],
                        searchable: true
                    },
                    {
                        targets: [2,],
                        searchable: true
                    },
                    {
                        targets: [3],
                        orderable: false
                    }
                ],
                ajax: {
                    url: "{{ route('admin.submission.list') }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'title'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'status',
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
            const editURL = "{{ route('admin.submission.edit', ['sub_id' => 'xxx_id']) }}";
            const delURL = "{{ route('admin.submission.del', ['sub_id' => 'xxx_id']) }}";
            return '<a href="' + editURL.replace('xxx_id', id) + '" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +
                '" class="btn btn-sm btn-danger">Delete</a>';
        }
    </script>
@endsection
