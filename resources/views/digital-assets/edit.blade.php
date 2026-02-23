@extends('layouts.app')

@section('title', 'Edit digital asset')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-pencil-square me-2"></i>Edit {{ $digitalAsset->name }}</h2>
        <p class="text-muted small mb-0">Update license or subscription details.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('digital-assets.show', $digitalAsset) }}" class="btn btn-outline-secondary">View</a>
        <a href="{{ route('digital-assets.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<form method="POST" action="{{ route('digital-assets.update', $digitalAsset) }}">
    @csrf
    @method('PUT')
    @include('digital-assets._form', ['digitalAsset' => $digitalAsset])
    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save changes</button>
        <a href="{{ route('digital-assets.show', $digitalAsset) }}" class="btn btn-cancel">Cancel</a>
    </div>
</form>
@endsection
