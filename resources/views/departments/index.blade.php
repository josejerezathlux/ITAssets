@extends('layouts.app')

@section('title', 'Departments')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-building me-2"></i>Departments</h2>
        <p class="text-muted small mb-0">Organize employees by department for assignments and reporting.</p>
    </div>
    @can('create', App\Models\Department::class)
        <a href="{{ route('departments.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New Department</a>
    @endcan
</div>

<div class="fluent-info-card fluent-dismissible mb-4" data-dismiss-key="departments-info">
    <i class="bi bi-info-circle-fill fluent-info-icon"></i>
    <div class="fluent-info-body">
        <div class="fluent-info-title">Departments</div>
        <p class="mb-0 small">Assign a department to each employee. Departments appear in the employee list and in asset assignment dropdowns.</p>
    </div>
    <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
</div>

<div class="corp-card">
    <div class="table-responsive">
    <table class="table corp-table align-middle mb-0">
        <thead>
            <tr>
                <th><i class="bi bi-building me-1"></i>Name</th>
                <th><i class="bi bi-code me-1"></i>Code</th>
                <th><i class="bi bi-people me-1"></i>Employees</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $department)
                <tr>
                    <td><a href="{{ route('departments.show', $department) }}" class="corp-link">{{ $department->name }}</a></td>
                    <td>@if($department->code)<span class="badge fluent-badge-neutral">{{ $department->code }}</span>@else<span class="text-muted">—</span>@endif</td>
                    <td><span class="badge fluent-badge-primary">{{ $department->employees_count }}</span></td>
                    <td>
                        @can('update', $department)
                            <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('delete', $department)
                            <form method="POST" action="{{ route('departments.destroy', $department) }}" class="d-inline" onsubmit="return confirm('Remove this department? Employees will be unassigned from it.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No departments. Add one to assign employees.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="fluent-pagination-wrap">{{ $departments->links() }}</div>
@endsection
