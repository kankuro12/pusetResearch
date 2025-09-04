@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary mb-3">Back to Users</a>
            <h4>User Details</h4>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>{{ $user->name }}</h5>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Verified:</strong> {{ $user->email_verified_at ? $user->email_verified_at->toDateTimeString() : 'No' }}</p>
                        <p><strong>Role:</strong> {{ $user->role }}</p>
                        <p><strong>Created:</strong> {{ $user->created_at->toDateTimeString() }}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card p-3">
                        <h5>Submissions</h5>
                        @if($user->submissions && $user->submissions->count())
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->submissions as $submission)
                                        <tr>
                                            <td>{{ $submission->id }}</td>
                                            <td>{{ $submission->title }}</td>
                                            <td>{{ $submission->status }}</td>
                                            <td>{{ $submission->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No submissions found for this user.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
