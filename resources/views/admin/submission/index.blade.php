@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.submission.index') }}">Submission</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.submission.add') }}" class="btn btn-primary btn-sm">Add</a>
@endsection
@section('active', 'submission')
@section('content')
    <div class="shadow p-3 mt-3 br-3 bg-white">
        <div class="table-responsive">
            <table class="table table-bordered" id="submissions">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
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
                        targets: [2],
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
                        render: function(data, type, row) {
                            var statusOptions = ['Pending', 'View', 'Acceptance', 'Rejected'];
                            var options = statusOptions.map((status, index) => {
                                return `<option value="${index}"${index === data ? ' selected' : ''}>${status}</option>`;
                            }).join('');
                            return `<select name="status" id="status_${row.id}" class="form-control">${options}</select>`;
                        }
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

        function updateStatus(id) {
            const status = $('#status_' + id).val();
            const data = {
                status: status
            };

            axios.post(`/admin/submission/edit/${id}`, data)
                .then(response => {
                    success('successfully updated')
                    // table.ajax.reload();
                    location.reload()
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }

        function getUrls(id) {
            const delURL = "{{ route('admin.submission.del', ['sub_id' => 'xxx_id']) }}";
            return `<a href="#" class="btn btn-sm btn-primary" onclick="updateStatus(${id})">Update</a>
                    <a onclick="return yes()" href="${delURL.replace('xxx_id', id)}" class="btn btn-sm btn-danger">Delete</a>`;
        }
    </script>
@endsection
