@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">Edit {{ $employee->name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('employees.show', $employee) }}" class="btn btn-outline-secondary">View</a>
        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<form method="POST" action="{{ route('employees.update', $employee) }}">
    @csrf
    @method('PUT')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                        <option value="">— None —</option>
                        @foreach($departments as $d)
                            <option value="{{ $d->id }}" {{ old('department_id', $employee->department_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email) }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
<<<<<<< HEAD
    <a href="{{ route('employees.index') }}" class="btn btn-link">Cancel</a>
=======
    <a href="{{ route('employees.index') }}" class="btn btn-cancel">Cancel</a>
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
</form>
@endsection
