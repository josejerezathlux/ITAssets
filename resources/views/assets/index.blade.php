@extends('layouts.app')

@section('title', 'Assets')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-laptop me-2"></i>Assets</h2>
        <p class="text-muted small mb-0">Manage devices, track assignments, and run reports.</p>
    </div>
    @can('create', App\Models\Asset::class)
        <a href="{{ route('assets.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New Asset</a>
    @endcan
</div>

<div class="fluent-tip-card fluent-dismissible mb-4" data-dismiss-key="assets-filter-tip">
    <i class="bi bi-lightbulb fluent-tip-icon"></i>
    <div class="fluent-tip-body">
        <div class="fluent-tip-title">Filter and export</div>
        <p class="mb-0 small">Use the filters above to find assets by category, status, room, or assignment. Export results to CSV or bulk-assign selected assets using the toolbar.</p>
    </div>
    <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
</div>

@php
    $hasActiveFilters = !empty($filters['category_id']) || !empty($filters['status']) || !empty($filters['room_id']) || (isset($filters['assigned']) && $filters['assigned'] !== '') || !empty($filters['search']);
@endphp
<form method="GET" id="assetFiltersForm" class="asset-filters mb-4">
    <div class="asset-filters-bar">
        <div class="asset-filters-row">
            <div class="asset-filter-search">
                <label for="filterSearch" class="asset-filter-label">Search</label>
                <input type="text" name="search" id="filterSearch" class="form-control form-control-sm" placeholder="Tag, serial, make, model…" value="{{ $filters['search'] ?? '' }}">
            </div>
            <div class="asset-filter-field">
                <label for="filterCategory" class="asset-filter-label">Category</label>
                <select name="category_id" id="filterCategory" class="form-select form-select-sm">
                    <option value="">All</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected(($filters['category_id'] ?? '') == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="asset-filter-field">
                <label for="filterStatus" class="asset-filter-label">Status</label>
                <select name="status" id="filterStatus" class="form-select form-select-sm">
                    <option value="">All</option>
                    @foreach(['in_use','in_stock','in_repair','retired','lost'] as $s)
                        <option value="{{ $s }}" @selected(($filters['status'] ?? '') === $s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="asset-filter-field">
                <label for="filterRoom" class="asset-filter-label">Room</label>
                <select name="room_id" id="filterRoom" class="form-select form-select-sm">
                    <option value="">All</option>
                    @foreach($rooms as $r)
                        <option value="{{ $r->id }}" @selected(($filters['room_id'] ?? '') == $r->id)>{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="asset-filter-field">
                <label for="filterAssigned" class="asset-filter-label">Assignment</label>
                <select name="assigned" id="filterAssigned" class="form-select form-select-sm">
                    <option value="">Any</option>
                    <option value="1" @selected(($filters['assigned'] ?? '') === '1')>Assigned</option>
                    <option value="0" @selected(isset($filters['assigned']) && $filters['assigned'] === '0')>Unassigned</option>
                </select>
            </div>
            <div class="asset-filter-actions">
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-funnel me-1"></i>Apply</button>
                @if($hasActiveFilters)
                    <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                @endif
            </div>
        </div>
        @if(auth()->user()->hasPermission('assets.export') || auth()->user()->hasPermission('assets.import'))
        <div class="asset-filters-toolbar">
            @if(auth()->user()->hasPermission('assets.export'))
            <a href="{{ route('assets.export.csv', request()->query()) }}" class="btn btn-link btn-sm text-decoration-none px-0"><i class="bi bi-download me-1"></i>Export CSV</a>
            @endif
            @if(auth()->user()->hasPermission('assets.import'))
            @if(auth()->user()->hasPermission('assets.export'))<span class="asset-filters-divider">·</span>@endif
            <a href="{{ route('assets.import.template') }}" class="btn btn-link btn-sm text-decoration-none px-0"><i class="bi bi-file-earmark-arrow-down me-1"></i>Download template</a>
            <span class="asset-filters-divider">·</span>
            <form action="{{ route('assets.import.csv') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                @csrf
                <input type="file" name="file" accept=".csv" class="d-none" id="importFile">
                <label for="importFile" class="btn btn-link btn-sm text-decoration-none px-0 mb-0 cursor-pointer"><i class="bi bi-upload me-1"></i>Import CSV</label>
                <button type="submit" class="btn btn-link btn-sm text-decoration-none px-0">Upload</button>
            </form>
            @endif
        </div>
        @endif
    </div>
</form>

@if(auth()->user()->hasPermission('assets.bulk'))
<form method="POST" action="{{ route('assets.bulk') }}">
    @csrf
    <div class="mb-2 d-flex gap-2 align-items-center flex-wrap">
        <input type="checkbox" id="selectAll" class="form-check-input">
        <label for="selectAll" class="form-check-label small"><i class="bi bi-check2-square me-1"></i>Select all</label>
        <select name="action" class="form-select form-select-sm w-auto">
            <option value="">Bulk action</option>
            @if(auth()->user()->hasPermission('assets.assign'))
            <option value="assign">Assign to employee</option>
            @endif
            <option value="move">Move to room</option>
            <option value="delete">Delete</option>
        </select>
        <select name="employee_id" class="form-select form-select-sm w-auto" style="display:none" id="empSelect">
            <option value="">Choose employee</option>
            @foreach(\App\Models\Employee::orderBy('name')->get() as $e)
                <option value="{{ $e->id }}">{{ $e->name }}</option>
            @endforeach
        </select>
        <select name="room_id" class="form-select form-select-sm w-auto" style="display:none" id="roomSelect">
            <option value="">Choose room</option>
            @foreach($rooms as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-outline-primary" id="bulkSubmit" disabled>Apply</button>
    </div>
@endif
    <div class="corp-card">
        <div class="table-responsive">
        <table class="table corp-table align-middle mb-0">
            <thead>
                <tr>
                    @if(auth()->user()->hasPermission('assets.bulk'))
                    <th><input type="checkbox" id="selectAllTop" class="form-check-input"></th>
                    @endif
                    <th><i class="bi bi-upc-scan me-1"></i>Tag</th>
                    <th><i class="bi bi-tags me-1"></i>Category</th>
                    <th><i class="bi bi-upc me-1"></i>Serial</th>
                    <th><i class="bi bi-pie-chart me-1"></i>Status</th>
                    <th><i class="bi bi-building me-1"></i>Room</th>
                    <th><i class="bi bi-person me-1"></i>Assigned</th>
                    <th><i class="bi bi-clock me-1"></i>Updated</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $asset)
                    @php
                        $statusBadge = match($asset->status) {
                            'in_use' => 'fluent-badge-success',
                            'in_stock' => 'fluent-badge-info',
                            'in_repair' => 'fluent-badge-warning',
                            'retired' => 'fluent-badge-neutral',
                            'lost' => 'fluent-badge-danger',
                            default => 'fluent-badge-neutral',
                        };
                    @endphp
                    <tr>
                        @if(auth()->user()->hasPermission('assets.bulk'))
                        <td><input type="checkbox" name="asset_ids[]" value="{{ $asset->id }}" class="row-check"></td>
                        @endif
                        <td><a href="{{ route('assets.show', $asset) }}" class="corp-link">{{ $asset->asset_tag }}</a></td>
                        <td><span class="badge fluent-badge-primary">{{ $asset->category?->name }}</span></td>
                        <td>{{ $asset->serial_number }}</td>
                        <td><span class="badge {{ $statusBadge }}">{{ ucfirst(str_replace('_',' ', $asset->status)) }}</span></td>
                        <td><span class="badge fluent-badge-neutral">{{ $asset->room?->name ?? '—' }}</span></td>
                        <td>@if($asset->assignedEmployee)<span class="badge fluent-badge-success"><i class="bi bi-person-check"></i> {{ $asset->assignedEmployee->name }}</span>@else<span class="badge fluent-badge-neutral">—</span>@endif</td>
                        <td><span class="text-muted small">{{ $asset->updated_at->diffForHumans() }}</span></td>
                        <td>
                            @can('update', $asset)
                                <a href="{{ route('assets.edit', $asset) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ auth()->user()->hasPermission('assets.bulk') ? 9 : 8 }}" class="text-center text-muted">No assets found.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
@if(auth()->user()->hasPermission('assets.bulk'))
</form>
@endif

<div class="fluent-pagination-wrap">
    {{ $assets->withQueryString()->links() }}
</div>

@push('scripts')
<script>
document.getElementById('selectAll')?.addEventListener('change', function() {
    document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
    document.getElementById('selectAllTop').checked = this.checked;
    document.getElementById('bulkSubmit').disabled = !document.querySelectorAll('.row-check:checked').length;
});
document.getElementById('selectAllTop')?.addEventListener('change', function() {
    document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
    document.getElementById('selectAll').checked = this.checked;
    document.getElementById('bulkSubmit').disabled = !document.querySelectorAll('.row-check:checked').length;
});
document.querySelectorAll('.row-check').forEach(cb => cb.addEventListener('change', function() {
    document.getElementById('bulkSubmit').disabled = !document.querySelectorAll('.row-check:checked').length;
}));
document.querySelector('select[name="action"]')?.addEventListener('change', function() {
    document.getElementById('empSelect').style.display = this.value === 'assign' ? 'inline-block' : 'none';
    document.getElementById('roomSelect').style.display = this.value === 'move' ? 'inline-block' : 'none';
});
</script>
@endpush
@endsection
