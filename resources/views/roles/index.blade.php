@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-shield-lock me-2"></i>Roles</h2>
        <p class="text-muted small mb-0">Define roles and permissions per module.</p>
    </div>
    @can('create', App\Models\Role::class)
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New Role</a>
    @endcan
</div>

<div class="corp-card">
    <div class="table-responsive">
    <table class="table corp-table align-middle mb-0">
        <thead>
            <tr>
                <th><i class="bi bi-shield me-1"></i>Name</th>
                <th><i class="bi bi-tag me-1"></i>Label</th>
                <th><i class="bi bi-people me-1"></i>Users</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td><a href="{{ route('roles.show', $role) }}" class="corp-link">{{ $role->name }}</a></td>
                    <td>{{ $role->label }}</td>
                    <td><span class="badge fluent-badge-primary">{{ $role->users_count }}</span></td>
                    <td>
                        @can('update', $role)
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('delete', $role)
                            <form method="POST" action="{{ route('roles.destroy', $role) }}" class="d-inline" onsubmit="return confirm('Delete this role? Users must be reassigned first.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No roles.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="fluent-pagination-wrap">{{ $roles->links() }}</div>
@endsection
