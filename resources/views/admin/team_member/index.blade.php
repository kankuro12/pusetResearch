@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.team.index') }}">Team</a>
    <a href="{{ route('admin.team.team_member.index', ['team_id' => $team->id]) }}">Team Member</a>
@endsection
@section('active', 'team')
@section('toolbar')
    <a href="{{ route('admin.team.team_member.add', ['team_id' => $team->id]) }}" class="btn btn-primary">Add</a>
@endsection
@section('content')
    <div class="shadow p-3 mt-3  br-3 bg-white rounded">
        <div class="table-responsive">
            <table class="table table-bordered" id="team_members">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
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
    @include('admin.layout.datatable')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#team_members').DataTable({
                columnDefs: [{
                        targets: [0, 1, 2, 3, 4],
                        searchable: true
                    },
                    {
                        targets: [5],
                        orderable: false
                    }
                ],
                ajax: {
                    url: "{{ route('admin.team.team_member.list',['team_id'=>$team->id]) }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'designation'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'address',
                        className: 'text-end'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return getUrls(data.id,data.team_id);
                        }
                    }
                ],
            })
        });

        function getUrls(id,team_id) {
            const editURL = "{{ route('admin.team.team_member.edit', ['team_member_id' => 'xxx_id','team_id'=>'abc_id']) }}";
            const delURL = "{{ route('admin.team.team_member.del', ['team_member_id' => 'xxx_id']) }}";
            return '<a href="' + editURL.replace('xxx_id', id).replace('abc_id', team_id) + '" class="btn btn-sm btn-primary">Edit</a> ' +
                '<a onclick="return yes()" href="' + delURL.replace('xxx_id', id) +
                '" class="btn btn-sm btn-danger">Delete</a>';
        }
    </script>
@endsection
