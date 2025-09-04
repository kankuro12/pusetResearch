@extends('admin.layout.app')

@section('header-Links')
    <a href="{{ route('admin.index') }}">Dashboard</a>
    <a href="{{ route('admin.users.unverified') }}">Unverified Users</a>
@endsection

@section('active','users')

@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <h4>Unverified Users</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.users.verify', ['user_id' => $user->id]) }}" method="POST" onsubmit="return confirm('Mark this user as verified?');">
                                @csrf
                                <button class="btn btn-sm btn-success">Verify</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
