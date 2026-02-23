@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-people me-2"></i>Employees</h2>
        <p class="text-muted small mb-0">People assets can be assigned to. They do not log in to the system.</p>
    </div>
    @can('create', App\Models\Employee::class)
        <a href="{{ route('employees.create') }}" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>New Employee</a>
    @endcan
</div>

<div class="fluent-info-card fluent-dismissible mb-4" data-dismiss-key="employees-info">
    <i class="bi bi-info-circle-fill fluent-info-icon"></i>
    <div class="fluent-info-body">
        <div class="fluent-info-title">Assignment targets</div>
        <p class="mb-0 small">When you check out an asset, you assign it to an employee. Add everyone who may receive devices so they appear in the assignment dropdown on assets.</p>
    </div>
    <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
</div>

<div class="corp-card">
    <div class="table-responsive">
    <table class="table corp-table align-middle mb-0">
        <thead>
            <tr>
                <th><i class="bi bi-person me-1"></i>Name</th>
                <th><i class="bi bi-building me-1"></i>Department</th>
                <th><i class="bi bi-envelope me-1"></i>Email</th>
                <th><i class="bi bi-telephone me-1"></i>Phone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td><a href="{{ route('employees.show', $employee) }}" class="corp-link">{{ $employee->name }}</a></td>
                    <td>@if($employee->department)<span class="badge fluent-badge-primary">{{ $employee->department->name }}</span>@else<span class="text-muted">—</span>@endif</td>
                    <td>{{ $employee->email ?? '—' }}</td>
                    <td>{{ $employee->phone ?? '—' }}</td>
                    <td>
                        @can('update', $employee)
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('delete', $employee)
                            <form method="POST" action="{{ route('employees.destroy', $employee) }}" class="d-inline" onsubmit="return confirm('Remove this employee? Any asset assignments will be cleared.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No employees. Add some to use the "Assigned to" dropdown on assets.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="fluent-pagination-wrap">{{ $employees->links() }}</div>
@endsection
