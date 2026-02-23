@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-person me-2"></i>{{ $user->name }}</h2>
        <p class="text-muted small mb-0">User account details.</p>
    </div>
    <div class="d-flex gap-2">
        @can('update', $user)
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $user)
            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Remove this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        @endcan
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<div class="corp-card">
    <div class="corp-card-body">
        <table class="table table-sm table-borderless mb-0">
            <tr><th width="120">Email</th><td>{{ $user->email }}</td></tr>
            <tr><th>Role</th><td>@if($user->role)<span class="badge fluent-badge-primary">{{ $user->role->label }}</span>@else<span class="text-muted">—</span>@endif</td></tr>
        </table>
    </div>
</div>
@endsection
