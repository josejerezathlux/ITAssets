@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-pencil-square me-2"></i>Edit {{ $user->name }}</h2>
        <p class="text-muted small mb-0">Update user and role. Leave password blank to keep current.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('users.show', $user) }}" class="btn btn-outline-secondary">View</a>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')
    <div class="corp-card">
        <div class="corp-card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">New password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                    <small class="text-muted">Leave blank to keep current. Min 12 characters, mixed case, numbers, symbols.</small>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm new password</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>
                <div class="col-12">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <select name="role_id" id="userRoleSelect" class="form-select @error('role_id') is-invalid @enderror" required>
                            @foreach($roles as $r)
                                <option value="{{ $r->id }}" {{ old('role_id', $user->role_id) == $r->id ? 'selected' : '' }}>{{ $r->label }}</option>
                            @endforeach
                        </select>
                        @can('create', App\Models\Role::class)
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newRoleModal"><i class="bi bi-plus-lg me-1"></i>New role</button>
                        @endcan
                    </div>
                    @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save changes</button>
        <a href="{{ route('users.index') }}" class="btn btn-cancel">Cancel</a>
    </div>
</form>

@can('create', App\Models\Role::class)
@isset($modules, $actionLabels)
@push('modals')
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel"><i class="bi bi-shield-plus me-2"></i>New role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="newRoleForm" method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="newRoleName" class="form-control" placeholder="e.g. editor" required>
                            <small class="text-muted">Lowercase, numbers, underscores only.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Label <span class="text-danger">*</span></label>
                            <input type="text" name="label" id="newRoleLabel" class="form-control" placeholder="e.g. Editor" required>
                        </div>
                    </div>
                    <h6 class="mb-2">Permissions</h6>
                    <div class="row g-2">
                        @foreach($modules as $moduleKey => $moduleConfig)
                            <div class="col-md-6 col-lg-4">
                                <div class="border rounded p-2">
                                    <h6 class="small mb-1">{{ $moduleConfig['label'] ?? $moduleKey }}</h6>
                                    @foreach($moduleConfig['actions'] ?? [] as $action)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $moduleKey }}.{{ $action }}" id="mperm-{{ $moduleKey }}-{{ $action }}">
                                            <label class="form-check-label small" for="mperm-{{ $moduleKey }}-{{ $action }}">{{ $actionLabels[$action] ?? ucfirst($action) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="newRoleFormError" class="alert alert-danger mt-2 d-none" role="alert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="newRoleSubmitBtn"><i class="bi bi-check-lg me-1"></i>Create role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
@endisset
@endcan

@push('scripts')
@can('create', App\Models\Role::class)
<script>
(function() {
    var form = document.getElementById('newRoleForm');
    if (!form) return;
    var select = document.getElementById('userRoleSelect');
    var modal = document.getElementById('newRoleModal');
    var errEl = document.getElementById('newRoleFormError');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        errEl.classList.add('d-none');
        var btn = document.getElementById('newRoleSubmitBtn');
        btn.disabled = true;
        var fd = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: fd,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        }).then(function(r) {
            return r.json().then(function(data) {
                if (r.ok) {
                    var opt = document.createElement('option');
                    opt.value = data.id;
                    opt.textContent = data.label;
                    opt.selected = true;
                    select.appendChild(opt);
                    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) bootstrap.Modal.getInstance(modal).hide();
                    form.reset();
                } else {
                    errEl.textContent = (data.message || (data.errors && Object.values(data.errors).flat().join(' ')) || 'Could not create role.');
                    errEl.classList.remove('d-none');
                }
            }).catch(function() {
                errEl.textContent = 'Could not create role.';
                errEl.classList.remove('d-none');
            });
        }).catch(function() {
            errEl.textContent = 'Network error.';
            errEl.classList.remove('d-none');
        }).finally(function() {
            btn.disabled = false;
        });
    });
})();
</script>
@endcan
@endpush
@endsection
