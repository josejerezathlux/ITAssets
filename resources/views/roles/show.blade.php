@extends('layouts.app')

@section('title', $role->label)

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-shield me-2"></i>{{ $role->label }}</h2>
        <p class="text-muted small mb-0">Role details and assigned users.</p>
    </div>
    <div class="d-flex gap-2">
        @can('update', $role)
            <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $role)
            <form method="POST" action="{{ route('roles.destroy', $role) }}" class="d-inline" onsubmit="return confirm('Delete this role? Users must be reassigned first.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        @endcan
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<div class="corp-card mb-3">
    <div class="corp-card-body">
        <table class="table table-sm table-borderless mb-0">
            <tr><th width="120">Name</th><td><code>{{ $role->name }}</code></td></tr>
            <tr><th>Users</th><td>{{ $role->users_count }}</td></tr>
        </table>
    </div>
</div>

@if($role->users_count > 0)
    <div class="corp-card">
        <div class="corp-card-header"><i class="bi bi-people me-2"></i>Users with this role</div>
        <div class="corp-card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($role->users as $u)
                    <li class="list-group-item">
                        <a href="{{ route('users.show', $u) }}" class="corp-link">{{ $u->name }}</a>
                        <span class="text-muted small ms-2">{{ $u->email }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@endsection
