@extends('layouts.app')

@section('title', 'New Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">New Category</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Back to list</a>
</div>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="auto from name if empty">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Add category</button>
<<<<<<< HEAD
    <a href="{{ route('categories.index') }}" class="btn btn-link">Cancel</a>
=======
    <a href="{{ route('categories.index') }}" class="btn btn-cancel">Cancel</a>
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
</form>
@endsection
