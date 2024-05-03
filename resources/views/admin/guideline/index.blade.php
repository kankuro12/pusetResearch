@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.guideline.index') }}">guideline</a>
@endsection
@section('active', 'guideline')
@section('toolbar')
    <a href="{{ route('admin.guideline.add') }}" class="btn btn-primary btn-sm">Add</a>
@endsection
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white rounded">
        <div class="table-responsive">
            <table class="table table-bordered" id="guidelines">
                <thead>
                    <tr>
                        <th>Title</th>
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
            table = $('#guidelines').DataTable({
                columnDefs: [{
                        targets: [0],
                        searchable: true
                    },
                    {
                        targets: [1],
                        orderable: false
                    }
                ],
                ajax: {
                    url: "{{ route('admin.guideline.list') }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'title',
                        className: 'text-start'
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
            const editURL = "{{ route('admin.guideline.edit', ['guideline_id' => 'xxx_id']) }}";
            const delURL = "{{ route('admin.guideline.del', ['guideline_id' => 'xxx_id']) }}";
            return '<a href="' + editURL.replace('xxx_id', id) + '" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +
                '" class="btn btn-sm btn-danger">Delete</a>';
        }
    </script>
@endsection
