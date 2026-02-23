@extends('layouts.app')

@section('title', 'Edit Room')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">Edit {{ $room->name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-secondary">View</a>
        <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<form method="POST" action="{{ route('rooms.update', $room) }}">
    @csrf
    @method('PUT')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $room->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $room->location) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $room->code) }}">
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
    <a href="{{ route('rooms.index') }}" class="btn btn-cancel">Cancel</a>
</form>
@endsection
