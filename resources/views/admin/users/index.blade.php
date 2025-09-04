@extends('admin.layout.app')

@section('css')
    @include('admin.layout.datatable')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>All Users</h4>
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success">Create User</a>
            </div>
            <table id="users-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Submissions</th>
                        <th>Verified</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <input type="hidden" name="user_id" id="cp_user_id">
                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="cp_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @include('admin.layout.datatable')
    <script>
        $(function(){
            // Configure axios CSRF header globally
            if (document.querySelector('meta[name="csrf-token"]')) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }

            const table = $('#users-table').DataTable({
                ajax: '{!! route('admin.users.datatable') !!}',
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'no_of_submissions' },
                    { data: 'verified' },
                    { data: 'created_at' },
                    { data: 'actions', orderable:false, searchable:false }
                ]
            });

            // open change password modal
            $(document).on('click', '.btn-change-password', function(e){
                const id = $(this).data('id');
                $('#cp_user_id').val(id);
                $('#changePasswordModal').modal('show');
            });

            // save password
            $('#cp_save').on('click', function(){
                const userId = $('#cp_user_id').val();
                const data = $('#changePasswordForm').serialize();
                axios.post(`/admin/users/change-password/${userId}`, data)
                    .then(res => {
                        toastr.success(res.data.message || 'Password updated');
                        $('#changePasswordModal').modal('hide');
                        table.ajax.reload();
                    }).catch(err => {
                        if (err.response && err.response.data && err.response.data.errors) {
                            const msgs = Object.values(err.response.data.errors).flat().join('<br>');
                            toastr.error(msgs);
                        } else {
                            toastr.error('Error saving password');
                        }
                    });
            });

            // verify user (only if currently unverified)
            $(document).on('click', '.btn-verify', function(){
                const id = $(this).data('id');
                const row = table.row($(this).closest('tr')).data();
                const isVerified = row && row.verified && row.verified !== 'No' && row.verified !== 0 && row.verified !== '0';
                if (isVerified) {
                    toastr.info('User is already verified');
                    return;
                }

                axios.post(`/admin/users/verify/${id}`)
                    .then(res => {
                        toastr.success(res.data.message || 'User verified');
                        table.ajax.reload();
                    }).catch(() => toastr.error('Error verifying user'));
            });

            // toggle block (only allowed for verified users)
            $(document).on('click', '.btn-toggle-block', function(){
                const id = $(this).data('id');
                const row = table.row($(this).closest('tr')).data();
                const isVerified = row && row.verified && row.verified !== 'No' && row.verified !== 0 && row.verified !== '0';
                if (!isVerified) {
                    toastr.error('Only verified users can be blocked/unblocked');
                    return;
                }
                axios.post(`/admin/users/toggle-block/${id}`)
                    .then(res => {
                        toastr.success(res.data.message);
                        table.ajax.reload();
                    }).catch(() => toastr.error('Error'));
            });
        });
    </script>
@endsection
