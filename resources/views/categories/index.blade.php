@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-tags me-2"></i>Asset Categories</h2>
        <p class="text-muted small mb-0">Types of assets (e.g. Laptop, Monitor). Each category can have custom fields.</p>
    </div>
    @can('create', App\Models\AssetCategory::class)
        <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New Category</a>
    @endcan
</div>

<div class="fluent-info-card fluent-dismissible mb-4" data-dismiss-key="categories-info">
    <i class="bi bi-info-circle-fill fluent-info-icon"></i>
    <div class="fluent-info-body">
        <div class="fluent-info-title">Categories and custom fields</div>
        <p class="mb-0 small">Categories define what kind of asset you're tracking. You can add custom fields per category (e.g. RAM for laptops, resolution for monitors) so each asset type has the right attributes.</p>
    </div>
    <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
</div>

<div class="corp-card">
    <div class="table-responsive">
    <table class="table corp-table align-middle mb-0">
        <thead>
            <tr>
                <th><i class="bi bi-tag me-1"></i>Name</th>
                <th><i class="bi bi-code-slash me-1"></i>Slug</th>
                <th><i class="bi bi-laptop me-1"></i>Assets</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><a href="{{ route('categories.show', $category) }}" class="corp-link">{{ $category->name }}</a></td>
                    <td><span class="badge fluent-badge-neutral">{{ $category->slug }}</span></td>
                    <td><span class="badge fluent-badge-primary">{{ $category->assets_count }}</span></td>
                    <td>
                        @can('update', $category)
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('delete', $category)
                            <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Delete this category? Assets in it will be deleted too.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No categories.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="fluent-pagination-wrap">{{ $categories->links() }}</div>
@endsection
