@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-pencil-square me-2"></i>Edit {{ $department->name }}</h2>
        <p class="text-muted small mb-0">Update department details.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('departments.show', $department) }}" class="btn btn-outline-secondary">View</a>
        <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<form method="POST" action="{{ route('departments.update', $department) }}">
    @csrf
    @method('PUT')
    <div class="corp-card">
        <div class="corp-card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $department->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $department->code) }}" placeholder="e.g. IT, HR">
                    @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save changes</button>
<<<<<<< HEAD
        <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Cancel</a>
=======
        <a href="{{ route('departments.index') }}" class="btn btn-cancel">Cancel</a>
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
    </div>
</form>
@endsection
