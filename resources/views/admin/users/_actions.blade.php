<div class="btn-group" role="group">
    @if(!$user->email_verified_at)
    <a href="{{ route('admin.users.verify', $user->id) }}" class="btn btn-sm btn-success">Verify</a>
    @endif
    <button type="button" class="btn btn-sm btn-warning btn-change-password" data-id="{{ $user->id }}">Change Password</button>
    @if($user->email_verified_at)

    <button type="button" class="btn btn-sm btn-danger btn-toggle-block" data-id="{{ $user->id }}">{{ $user->email_verified_at ? 'Block' : 'Unblock' }}</button>
    @endif
</div>
