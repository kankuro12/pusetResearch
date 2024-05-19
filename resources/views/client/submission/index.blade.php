@extends('client.layout.app')
@section('header-link')
    <a href="{{ route('client.submission.index') }}">Submissions</a>
@endsection
@section('active', 'submission')
@section('toolbar')
    <a href="{{ route('client.submission.add') }}" class="btn btn-sm btn-primary">Add New Submission</a>
@endsection
@section('content')
    <div class="shadow mt-2 p-2">
        <div class="table-responsive">
            <table class="table table-bordered" id="sub">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    @include('client.layout.datatable')
    <script>
        var table;
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#sub')) {
                $('#sub').DataTable().clear().destroy();
            }
            table = $('#sub').DataTable({
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
                    url: "{{ route('client.submission.list') }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'title',
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
            const editURL = `{{ route('client.submission.edit', ['sub_id' => 'xxx_id']) }}`;
            const delURL = `{{ route('client.submission.del', ['sub_id' => 'xxx_id']) }}`;
            const editLink = `<a href="${editURL.replace('xxx_id', id)}" class="btn btn-sm btn-primary">Edit</a>`;
            const deleteLink =
                `<a onclick="return yes()" href="${delURL.replace('xxx_id', id)}" class="btn btn-sm btn-danger">Delete</a>`;
            return `${editLink} ${deleteLink}`;
        }
    </script>
@endsection
