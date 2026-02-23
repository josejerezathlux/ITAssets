@extends('layouts.app')

@section('title', 'License expiration')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-calendar-x me-2"></i>License expiration</h2>
        <p class="text-muted small mb-0">Sorted by soonest. Green = plenty of time, yellow = getting close, red = urgent, black = expired.</p>
    </div>
    <a href="{{ route('digital-assets.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Digital assets</a>
</div>

<div class="license-expiry-view">
    @if($items->isEmpty())
        <div class="corp-card">
            <div class="corp-card-body text-center py-4">
                <p class="text-muted mb-2">No end or renewal dates set. Add dates on digital assets to see them here.</p>
                <a href="{{ route('digital-assets.index') }}" class="btn btn-primary btn-sm">View digital assets</a>
            </div>
        </div>
    @else
        <div class="corp-card">
            <div class="corp-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <span><i class="bi bi-list-ul me-2"></i>{{ $items->count() }} with expiry date</span>
                <span class="license-expiry-legend">
                    <span class="license-expiry-legend__item" title="Expires in more than 1 month"><i class="license-expiry-dot license-expiry-dot--seg-green"></i> Plenty of time</span>
                    <span class="license-expiry-legend__item" title="Expires in less than 1 month"><i class="license-expiry-dot license-expiry-dot--seg-yellow"></i> Getting close</span>
                    <span class="license-expiry-legend__item" title="Expires in less than 1 week"><i class="license-expiry-dot license-expiry-dot--seg-red"></i> Urgent</span>
                    <span class="license-expiry-legend__item" title="Already expired"><i class="license-expiry-dot license-expiry-dot--seg-expired"></i> Expired</span>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table corp-table align-middle mb-0 license-expiry-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Vendor</th>
                            <th>Type</th>
                            <th class="text-center" style="width: 6rem;">Seats</th>
                            <th class="text-end" style="width: 7rem;">Expires</th>
                            <th class="text-center" style="width: 6rem;">Left</th>
                            <th style="width: 2rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            @php
                                $seg = $item->status === 'expired' ? 'expired' : ($item->days_left > 30 ? 'green' : ($item->days_left > 7 ? 'yellow' : 'red'));
                            @endphp
                            <tr class="license-expiry-row license-expiry-row--{{ $item->status }} license-expiry-row--seg-{{ $seg }}">
                                <td class="license-expiry-name-cell">
                                    <div class="license-expiry-name-cell__inner">
                                        <a href="{{ route('digital-assets.show', $item->asset) }}" class="corp-link fw-medium text-nowrap">{{ $item->asset->name }}</a>
                                        <div class="progress license-expiry-progress license-expiry-progress--seg-{{ $seg }}" role="progressbar" aria-valuenow="{{ round($item->elapsed_pct) }}" aria-valuemin="0" aria-valuemax="100" aria-label="Time elapsed: {{ round($item->elapsed_pct) }}%">
                                            <div class="progress-bar" style="width: {{ $item->elapsed_pct }}%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="small text-nowrap">{{ $item->asset->vendor ?? '—' }}</td>
                                <td class="small text-nowrap">{{ \App\Models\DigitalAsset::typeOptions()[$item->asset->type] ?? $item->asset->type }}</td>
                                <td class="text-center small text-nowrap">{{ $item->asset->assignments_count ?? 0 }} / {{ $item->asset->quantity }}</td>
                                <td class="text-end small text-nowrap">{{ $item->expiry_date->format('M j, Y') }}</td>
                                <td class="text-center">
                                    @if($item->status === 'expired')
                                        @php $daysExpired = abs($item->days_left); @endphp
                                        <span class="badge license-expiry-badge license-expiry-badge--seg-expired license-expiry-badge--expired-aura">{{ $daysExpired === 1 ? '1 Day Expired' : $daysExpired . ' Days Expired' }}</span>
                                    @elseif($item->days_left === 0)
                                        <span class="badge license-expiry-badge license-expiry-badge--seg-red">Today</span>
                                    @else
                                        <span class="badge license-expiry-badge license-expiry-badge--seg-{{ $seg }}">{{ $item->days_left }}d</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('digital-assets.show', $item->asset) }}" class="btn btn-sm btn-link p-0 text-muted" aria-label="View"><i class="bi bi-chevron-right"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

@push('styles')
<link href="{{ rtrim(config('app.asset_url') ?? url('/'), '/') }}/css/license-expiry.css" rel="stylesheet">
@endpush
@endsection
