@extends('layouts.app')

@section('title', $department->name)

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-building me-2"></i>{{ $department->name }}</h2>
        <p class="text-muted small mb-0">Department details and employees.</p>
    </div>
    <div class="d-flex gap-2">
        @can('update', $department)
            <a href="{{ route('departments.edit', $department) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $department)
            <form method="POST" action="{{ route('departments.destroy', $department) }}" class="d-inline" onsubmit="return confirm('Remove this department? Employees will be unassigned from it.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        @endcan
        <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<div class="corp-card mb-3">
    <div class="corp-card-body">
        <table class="table table-sm table-borderless mb-0">
            @if($department->code)
                <tr><th width="120">Code</th><td><span class="badge fluent-badge-neutral">{{ $department->code }}</span></td></tr>
            @endif
            <tr><th>Employees</th><td>{{ $department->employees_count }}</td></tr>
        </table>
    </div>
</div>

@if($department->employees_count > 0)
    <div class="corp-card">
        <div class="corp-card-header"><i class="bi bi-people me-2"></i>Employees in this department</div>
        <div class="corp-card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($department->employees as $employee)
                    <li class="list-group-item">
                        <a href="{{ route('employees.show', $employee) }}" class="corp-link">{{ $employee->name }}</a>
                        @if($employee->email)<span class="text-muted small ms-2">{{ $employee->email }}</span>@endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@endsection
