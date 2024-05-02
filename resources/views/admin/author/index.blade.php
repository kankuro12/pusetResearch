@extends('admin.layout.app')
@section('header-Links')
    <a href="{{route('admin.author.index')}}">author</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.author.add')}}" class="btn btn-primary">Add</a>
@endsection
@section('active','authors')
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white rounded">
        <div class="table-responsive">
            <table class="table table-bordered" id="Authors">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Designation</th>
                        <th>Organization</th>
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
            table = $('#Authors').DataTable({
                columnDefs: [{
                        targets: [0, 1],
                        searchable: true
                    },
                    {
                        targets: [2, 3, ],
                        searchable: false
                    },
                    {
                        targets: [4],
                        orderable: false
                    }
                ],
                ajax: {
                    url: "{{ route('admin.author.list') }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'link'
                    },
                    {
                        data: 'designation'
                    },
                    {
                        data: 'organization'
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
            const editURL = "{{ route('admin.author.edit', ['author_id' => 'xxx_id']) }}";
            const delURL = "{{ route('admin.author.del', ['author_id' => 'xxx_id']) }}";
            return '<a href="' + editURL.replace('xxx_id', id) + '" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +
                '" class="btn btn-sm btn-danger">Delete</a>';
        }
    </script>
@endsection
