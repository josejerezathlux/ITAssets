@extends('layouts.app')

@section('title', 'New Role')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-shield-plus me-2"></i>New Role</h2>
        <p class="text-muted small mb-0">Create a role and assign permissions by module and action.</p>
    </div>
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Back to list</a>
</div>

<form method="POST" action="{{ route('roles.store') }}">
    @csrf
    <div class="corp-card mb-3">
        <div class="corp-card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. editor" required>
                    <small class="text-muted">Lowercase letters, numbers, underscores only.</small>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Label <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror" value="{{ old('label') }}" placeholder="e.g. Editor" required>
                    @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="corp-card">
        <div class="corp-card-header"><i class="bi bi-key me-2"></i>Permissions</div>
        <div class="corp-card-body">
            <div class="row g-3">
                @foreach($modules as $moduleKey => $moduleConfig)
                    <div class="col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <h6 class="mb-2">{{ $moduleConfig['label'] ?? $moduleKey }}</h6>
                            @foreach($moduleConfig['actions'] ?? [] as $action)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $moduleKey }}.{{ $action }}" id="perm-{{ $moduleKey }}-{{ $action }}" @if(in_array($moduleKey.'.'.$action, old('permissions', []))) checked @endif>
                                    <label class="form-check-label" for="perm-{{ $moduleKey }}-{{ $action }}">{{ $actionLabels[$action] ?? ucfirst($action) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Create role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-cancel">Cancel</a>
    </div>
</form>
@endsection
