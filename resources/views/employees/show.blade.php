@extends('layouts.app')

@section('title', $employee->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">{{ $employee->name }}</h1>
    <div class="d-flex gap-2">
        @can('update', $employee)
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $employee)
            <form method="POST" action="{{ route('employees.destroy', $employee) }}" class="d-inline" onsubmit="return confirm('Remove this employee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        @endcan
        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <table class="table table-sm table-borderless mb-0">
            <tr><th width="120">Department</th><td>{{ $employee->department?->name ?? '—' }}</td></tr>
            <tr><th>Email</th><td>{{ $employee->email ?? '—' }}</td></tr>
            <tr><th>Phone</th><td>{{ $employee->phone ?? '—' }}</td></tr>
            <tr><th>Assets assigned</th><td>{{ $employee->assets_count ?? 0 }}</td></tr>
        </table>
    </div>
</div>

@if(($employee->assets_count ?? 0) > 0)
    <div class="card">
        <div class="card-header">Currently assigned assets</div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($employee->assets as $asset)
                    <li class="list-group-item">
                        <a href="{{ route('assets.show', $asset) }}" class="corp-link">{{ $asset->asset_tag }}</a>
                        <span class="text-muted"> — {{ $asset->category?->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@endsection
