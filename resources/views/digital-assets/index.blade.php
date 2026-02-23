@extends('layouts.app')

@section('title', 'Digital assets')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-cloud-check me-2"></i>Digital assets</h2>
        <p class="text-muted small mb-0">Licenses, software subscriptions, SaaS, and support contracts.</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('digital-assets.expiring') }}" class="btn btn-outline-primary"><i class="bi bi-calendar-x me-1"></i>License expiration</a>
        @can('create', App\Models\DigitalAsset::class)
            <a href="{{ route('digital-assets.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New digital asset</a>
        @endcan
    </div>
</div>

<div class="fluent-info-card fluent-dismissible mb-4" data-dismiss-key="digital-assets-info">
    <i class="bi bi-info-circle-fill fluent-info-icon"></i>
    <div class="fluent-info-body">
        <div class="fluent-info-title">Track licenses and subscriptions</div>
        <p class="mb-0 small">Record software licenses, cloud subscriptions, maintenance contracts, and SaaS. Track renewal dates, cost, and assigned seats. Use filters below to narrow by type or status.</p>
    </div>
    <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
</div>

<form method="GET" class="asset-filters-bar mb-3">
    <div class="asset-filters-row flex-wrap">
        <div class="asset-filter-field">
            <label for="filterType" class="asset-filter-label">Type</label>
            <select name="type" id="filterType" class="form-select form-select-sm">
                <option value="">All</option>
                @foreach(\App\Models\DigitalAsset::typeOptions() as $value => $label)
                    <option value="{{ $value }}" @selected(request('type') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="asset-filter-field">
            <label for="filterStatus" class="asset-filter-label">Status</label>
            <select name="status" id="filterStatus" class="form-select form-select-sm">
                <option value="">All</option>
                @foreach(\App\Models\DigitalAsset::statusOptions() as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="asset-filter-field">
            <label for="filterVendor" class="asset-filter-label">Vendor</label>
            <input type="text" name="vendor" id="filterVendor" class="form-control form-control-sm" placeholder="Vendor name" value="{{ request('vendor') }}">
        </div>
        <div class="asset-filter-field d-flex align-items-end">
            <button type="submit" class="btn btn-sm btn-primary me-1">Filter</button>
            <a href="{{ route('digital-assets.index') }}" class="btn btn-sm btn-cancel">Clear</a>
        </div>
    </div>
</form>

<div class="corp-card">
    <div class="table-responsive">
        <table class="table corp-table align-middle mb-0">
            <thead>
                <tr>
                    <th><i class="bi bi-tag me-1"></i>Name</th>
                    <th>Type</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th>Cost</th>
                    <th>Seats</th>
                    <th>Renewal / End</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($digitalAssets as $da)
                    <tr>
                        <td><a href="{{ route('digital-assets.show', $da) }}" class="corp-link">{{ $da->name }}</a></td>
                        <td><span class="badge fluent-badge-neutral">{{ \App\Models\DigitalAsset::typeOptions()[$da->type] ?? $da->type }}</span></td>
                        <td>{{ $da->vendor ?? '—' }}</td>
                        <td><span class="badge @if($da->status === 'active') fluent-badge-success @elseif($da->status === 'expired' || $da->status === 'cancelled') fluent-badge-danger @else fluent-badge-warning @endif">{{ \App\Models\DigitalAsset::statusOptions()[$da->status] ?? $da->status }}</span></td>
                        <td>@if($da->cost !== null){{ number_format($da->cost, 2) }} {{ $da->currency }}@else—@endif</td>
                        <td>{{ $da->assignments_count }} / {{ $da->quantity }}</td>
                        <td>
                            @if($da->renewal_date){{ $da->renewal_date->format('M j, Y') }}
                            @elseif($da->end_date){{ $da->end_date->format('M j, Y') }}
                            @else—@endif
                        </td>
                        <td>
                            @can('update', $da)
                                <a href="{{ route('digital-assets.edit', $da) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            @endcan
                            @can('delete', $da)
                                <form method="POST" action="{{ route('digital-assets.destroy', $da) }}" class="d-inline" onsubmit="return confirm('Delete this digital asset? Assignments will be removed.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No digital assets. Add a license or subscription to get started.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="fluent-pagination-wrap">{{ $digitalAssets->links() }}</div>
@endsection
