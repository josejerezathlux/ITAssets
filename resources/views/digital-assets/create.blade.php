@extends('layouts.app')

@section('title', 'New digital asset')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-cloud-plus me-2"></i>New digital asset</h2>
        <p class="text-muted small mb-0">Add a license, subscription, or SaaS entry.</p>
    </div>
    <a href="{{ route('digital-assets.index') }}" class="btn btn-outline-secondary">Back to list</a>
</div>

<form method="POST" action="{{ route('digital-assets.store') }}">
    @csrf
    @include('digital-assets._form')
    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Create digital asset</button>
        <a href="{{ route('digital-assets.index') }}" class="btn btn-cancel">Cancel</a>
    </div>
</form>
@endsection
