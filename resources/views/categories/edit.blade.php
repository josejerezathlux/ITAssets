@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">Edit {{ $category->name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-secondary">View</a>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<form method="POST" action="{{ route('categories.update', $category) }}">
    @csrf
    @method('PUT')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug) }}">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
    <a href="{{ route('categories.index') }}" class="btn btn-cancel">Cancel</a>
</form>
@endsection
