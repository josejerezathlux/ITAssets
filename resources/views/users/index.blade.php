@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-person-badge me-2"></i>Users</h2>
        <p class="text-muted small mb-0">Manage user accounts and access.</p>
    </div>
    @can('create', App\Models\User::class)
        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>New User</a>
    @endcan
</div>

<div class="corp-card">
    <div class="table-responsive">
    <table class="table corp-table align-middle mb-0">
        <thead>
            <tr>
                <th><i class="bi bi-person me-1"></i>Name</th>
                <th><i class="bi bi-envelope me-1"></i>Email</th>
                <th><i class="bi bi-shield me-1"></i>Role</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
                <tr>
                    <td><a href="{{ route('users.show', $u) }}" class="corp-link">{{ $u->name }}</a></td>
                    <td>{{ $u->email }}</td>
                    <td>@if($u->role)<span class="badge fluent-badge-primary">{{ $u->role->label }}</span>@else<span class="text-muted">—</span>@endif</td>
                    <td>
                        @can('update', $u)
                            <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('delete', $u)
                            <form method="POST" action="{{ route('users.destroy', $u) }}" class="d-inline" onsubmit="return confirm('Remove this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No users.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="fluent-pagination-wrap">{{ $users->links() }}</div>
@endsection
