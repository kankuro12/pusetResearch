@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.team.index') }}">Team</a>
@endsection
@section('active', 'team')
@section('toolbar')
    <a href="{{ route('admin.team.add') }}" class="btn btn-primary btn-sm">Add</a>
@endsection
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white rounded">
        <div class="table-responsive">
            <table class="table table-bordered" id="teams">
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
            table = $('#teams').DataTable({
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
                    url: "{{ route('admin.team.list') }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'title'
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
            const editURL = "{{ route('admin.team.edit', ['team_id' => 'xxx_id']) }}";
            const delURL = "{{ route('admin.team.del', ['team_id' => 'xxx_id']) }}";
            {{-- const teamMember = "{{ route('admin.team.team_member.index', ['team_id' => 'abc_id']) }}" --}};
            return '<a href="' + editURL.replace('xxx_id', id) + '" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +
                '" class="btn btn-sm btn-danger">Delete</a> ' {{-- + '<a href="' + teamMember.replace('abc_id', id) +
                '" class="btn btn-sm btn-success">Manage Members</a> ' --}};
        }
    </script>
@endsection
