@extends('layouts.app')

@section('title', 'Find assets')

@push('styles')
<link href="{{ asset('css/find-assets.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="find-assets-view">
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-search me-2"></i>Find assets</h2>
        <p class="text-muted small mb-0">Browse by location and person. Click an asset or employee to open details.</p>
    </div>
    <a href="{{ route('assets.index') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-list-ul me-1"></i>All assets</a>
</div>

<div class="corp-card mb-4">
    <div class="corp-card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="find-search" class="form-label small mb-0 fw-medium">Search</label>
                <input type="text" name="search" id="find-search" class="form-control form-control-sm" placeholder="Tag, person, category…" value="{{ $filters['search'] ?? '' }}">
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                <label for="find-room" class="form-label small mb-0 fw-medium">Room</label>
                <select name="room_id" id="find-room" class="form-select form-select-sm">
                    <option value="">All rooms</option>
                    @foreach($rooms as $r)
                        <option value="{{ $r->id }}" @selected(($filters['room_id'] ?? '') == (string)$r->id)>{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                <label for="find-status" class="form-label small mb-0 fw-medium">Status</label>
                <select name="status" id="find-status" class="form-select form-select-sm">
                    <option value="">All</option>
                    @foreach(['in_use'=>'In use','in_stock'=>'In stock','in_repair'=>'In repair','retired'=>'Retired','lost'=>'Lost'] as $v => $l)
                        <option value="{{ $v }}" @selected(($filters['status'] ?? '') === $v)>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-2">
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-funnel me-1"></i>Apply</button>
            </div>
        </form>
    </div>
</div>

<div class="row g-3">
    @forelse($roomSections as $section)
        @php
            $room = $section->room;
            $roomName = $room ? $room->name : 'No room assigned';
            $roomSub = $room ? ($room->location ?: $room->code) : null;
        @endphp
        <div class="col-12 col-md-6 col-lg-4">
            <div class="corp-card find-room-card h-100 d-flex flex-column">
                <div class="corp-card-header d-flex align-items-center justify-content-between flex-wrap gap-2 py-2 px-3">
                    <div class="d-flex align-items-center gap-2 min-width-0">
                        <span class="find-room-icon"><i class="bi bi-building"></i></span>
                        <div class="min-width-0">
                            <span class="d-block fw-semibold text-truncate">{{ $roomName }}</span>
                            @if($roomSub)
                                <span class="small text-muted">{{ $roomSub }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="badge fluent-badge-primary">{{ $section->total_assets }}</span>
                </div>
                <div class="corp-card-body find-room-body p-0 flex-grow-1 overflow-auto">
                    @if($section->total_assets === 0)
                        <p class="small text-muted mb-0 px-3 py-3">No assets with current filters.</p>
                    @else
                        @foreach($section->desks as $desk)
                            <div class="find-employee-row {{ !$desk->employee ? 'find-employee-row--unassigned' : '' }}">
                                <div class="find-employee-head">
                                    @if($desk->employee)
                                        <span class="find-employee-avatar" aria-hidden="true">{{ strtoupper(mb_substr($desk->employee->name, 0, 1)) }}</span>
                                        <a href="{{ route('employees.show', $desk->employee) }}" class="find-employee-name">{{ $desk->employee->name }}</a>
                                        <span class="find-employee-count">{{ $desk->assets->count() }} asset{{ $desk->assets->count() !== 1 ? 's' : '' }}</span>
                                    @else
                                        <span class="find-employee-avatar find-employee-avatar--unassigned" aria-hidden="true"><i class="bi bi-inbox"></i></span>
                                        <span class="find-employee-name find-employee-unassigned">Unassigned</span>
                                        <span class="find-employee-count">{{ $desk->assets->count() }} asset{{ $desk->assets->count() !== 1 ? 's' : '' }}</span>
                                    @endif
                                </div>
                                <ul class="find-asset-list">
                                    @foreach($desk->assets as $asset)
                                        <li class="find-asset-item">
                                            <a href="{{ route('assets.show', $asset) }}" class="find-asset-row d-flex align-items-center gap-2">
                                                <span class="find-asset-icon"><i class="bi {{ \App\Http\Controllers\AssetFinderController::iconForCategory($asset->category?->slug) }}"></i></span>
                                                <span class="find-asset-tag corp-link flex-grow-1 min-width-0 text-truncate">{{ $asset->asset_tag }}</span>
                                                <span class="find-asset-cat small text-muted flex-shrink-0 text-truncate" style="max-width: 7rem;">{{ $asset->category?->name ?? '—' }}</span>
                                                @php
                                                    $statusClass = match($asset->status) {
                                                        'in_use' => 'fluent-badge-success',
                                                        'in_stock' => 'fluent-badge-info',
                                                        'in_repair' => 'fluent-badge-warning',
                                                        'retired' => 'fluent-badge-neutral',
                                                        'lost' => 'fluent-badge-danger',
                                                        default => 'fluent-badge-neutral',
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }} flex-shrink-0">{{ ucfirst(str_replace('_', ' ', $asset->status)) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="corp-card">
                <div class="corp-card-body text-center py-5">
                    <i class="bi bi-inbox display-4 text-muted opacity-50 d-block mb-3"></i>
                    <h3 class="h6 fw-semibold mb-1">No assets match</h3>
                    <p class="text-muted small mb-0">Try changing the search or filters above.</p>
                </div>
            </div>
        </div>
    @endforelse
</div>
</div>
@endsection
