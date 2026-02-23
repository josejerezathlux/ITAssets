@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-file-earmark-text me-2"></i>Reports</h2>
        <p class="text-muted small mb-0">Generate and print detailed reports. Open any report to print or save as PDF from your browser.</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.show', 'summary') }}" target="_blank" class="corp-card report-card-link text-decoration-none">
            <div class="corp-card-body">
                <span class="report-card-icon"><i class="bi bi-pie-chart"></i></span>
                <h3 class="h6 mb-1">Asset Summary</h3>
                <p class="text-muted small mb-0">Totals, counts by status and category, assigned count.</p>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.show', 'by-category') }}" target="_blank" class="corp-card report-card-link text-decoration-none">
            <div class="corp-card-body">
                <span class="report-card-icon"><i class="bi bi-tags"></i></span>
                <h3 class="h6 mb-1">Assets by Category</h3>
                <p class="text-muted small mb-0">Full list of assets grouped by category.</p>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.show', 'by-status') }}" target="_blank" class="corp-card report-card-link text-decoration-none">
            <div class="corp-card-body">
                <span class="report-card-icon"><i class="bi bi-bar-chart"></i></span>
                <h3 class="h6 mb-1">Assets by Status</h3>
                <p class="text-muted small mb-0">Full list of assets grouped by status.</p>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.show', 'assigned') }}" target="_blank" class="corp-card report-card-link text-decoration-none">
            <div class="corp-card-body">
                <span class="report-card-icon"><i class="bi bi-person-check"></i></span>
                <h3 class="h6 mb-1">Assigned Assets</h3>
                <p class="text-muted small mb-0">Assets currently assigned to employees.</p>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.show', 'warranty') }}" target="_blank" class="corp-card report-card-link text-decoration-none">
            <div class="corp-card-body">
                <span class="report-card-icon"><i class="bi bi-clock"></i></span>
                <h3 class="h6 mb-1">Warranty Expiring (90 days)</h3>
                <p class="text-muted small mb-0">Assets with warranty expiring in the next 90 days.</p>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.show', 'maintenance') }}" target="_blank" class="corp-card report-card-link text-decoration-none">
            <div class="corp-card-body">
                <span class="report-card-icon"><i class="bi bi-wrench"></i></span>
                <h3 class="h6 mb-1">Maintenance Summary</h3>
                <p class="text-muted small mb-0">Recent maintenance logs (repair, upgrade, inspection).</p>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('reports.show', 'employees-with-assets') }}" target="_blank" class="corp-card report-card-link text-decoration-none">
            <div class="corp-card-body">
                <span class="report-card-icon"><i class="bi bi-people"></i></span>
                <h3 class="h6 mb-1">Employees with Assigned Assets</h3>
                <p class="text-muted small mb-0">Employees and the list of assets assigned to each.</p>
            </div>
        </a>
    </div>
</div>
@endsection
