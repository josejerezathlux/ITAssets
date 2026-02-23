@extends('layouts.app')

@section('title', 'New Department')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-building-add me-2"></i>New Department</h2>
        <p class="text-muted small mb-0">Add a department for organizing employees.</p>
    </div>
    <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Back to list</a>
</div>

<form method="POST" action="{{ route('departments.store') }}">
    @csrf
    <div class="corp-card">
        <div class="corp-card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="e.g. IT, HR">
                    @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Add department</button>
        <a href="{{ route('departments.index') }}" class="btn btn-cancel">Cancel</a>
    </div>
</form>
@endsection
