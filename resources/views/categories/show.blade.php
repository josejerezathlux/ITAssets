@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">{{ $category->name }}</h1>
    <div class="d-flex gap-2">
        @can('update', $category)
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $category)
            <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Delete this category?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        @endcan
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <table class="table table-sm table-borderless mb-0">
            <tr><th width="120">Slug</th><td><code>{{ $category->slug }}</code></td></tr>
            <tr><th>Assets</th><td>{{ $category->assets_count }}</td></tr>
        </table>
    </div>
</div>

@if($category->fields->isNotEmpty())
    <div class="card mb-3">
        <div class="card-header">Custom fields for this category</div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($category->fields as $field)
                    <li class="list-group-item">{{ $field->name }} ({{ $field->key }}) — {{ $field->input_type }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if($category->assets_count > 0)
    <div class="card">
        <div class="card-header">Assets in this category</div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($category->assets as $asset)
                    <li class="list-group-item">
                        <a href="{{ route('assets.show', $asset) }}" class="corp-link">{{ $asset->asset_tag }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@endsection
