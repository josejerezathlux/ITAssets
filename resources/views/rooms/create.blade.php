@extends('layouts.app')

@section('title', 'New Room')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">New Room</h1>
    <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">Back to list</a>
</div>

<form method="POST" action="{{ route('rooms.store') }}">
    @csrf
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Add room</button>
    <a href="{{ route('rooms.index') }}" class="btn btn-cancel">Cancel</a>
</form>
@endsection
