@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="corp-page-header dashboard-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-grid-1x2 me-2"></i>Dashboard</h2>
        <p class="text-muted small mb-0">Asset inventory, people, and locations at a glance. Click any card or chart to drill down.</p>
    </div>
</div>

<div class="dashboard-v2">
    <div class="fluent-info-card fluent-dismissible mb-3" data-dismiss-key="dashboard-overview">
        <i class="bi bi-info-circle-fill fluent-info-icon"></i>
        <div class="fluent-info-body">
            <div class="fluent-info-title">Interactive overview</div>
            <p class="mb-0 small">Stats and charts link to filtered views. Use <strong>Find assets</strong> to browse by room or person, or open <strong>Reports</strong> for print-ready summaries.</p>
        </div>
        <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
    </div>

    {{-- Stats badges --}}
    <div class="dashboard-badges">
        @can('viewAny', App\Models\Asset::class)
        <a href="{{ route('assets.index') }}" class="dashboard-badge dashboard-badge--primary"><span class="dashboard-badge__count">{{ $totalAssets }}</span> Assets</a>
        @else
        <span class="dashboard-badge dashboard-badge--primary"><span class="dashboard-badge__count">{{ $totalAssets }}</span> Assets</span>
        @endcan
        @can('viewAny', App\Models\Employee::class)
        <a href="{{ route('employees.index') }}" class="dashboard-badge dashboard-badge--teal"><span class="dashboard-badge__count">{{ $totalEmployees }}</span> Employees</a>
        @else
        <span class="dashboard-badge dashboard-badge--teal"><span class="dashboard-badge__count">{{ $totalEmployees }}</span> Employees</span>
        @endcan
        @can('viewAny', App\Models\Department::class)
        <a href="{{ route('departments.index') }}" class="dashboard-badge dashboard-badge--violet"><span class="dashboard-badge__count">{{ $totalDepartments->count() }}</span> Departments</a>
        @else
        <span class="dashboard-badge dashboard-badge--violet"><span class="dashboard-badge__count">{{ $totalDepartments->count() }}</span> Departments</span>
        @endcan
        @can('viewAny', App\Models\Room::class)
        <a href="{{ route('rooms.index') }}" class="dashboard-badge dashboard-badge--cyan"><span class="dashboard-badge__count">{{ $totalRooms->count() }}</span> Rooms</a>
        @else
        <span class="dashboard-badge dashboard-badge--cyan"><span class="dashboard-badge__count">{{ $totalRooms->count() }}</span> Rooms</span>
        @endcan
        @can('viewAny', App\Models\AssetCategory::class)
        <a href="{{ route('categories.index') }}" class="dashboard-badge dashboard-badge--amber"><span class="dashboard-badge__count">{{ $totalCategories }}</span> Categories</a>
        @else
        <span class="dashboard-badge dashboard-badge--amber"><span class="dashboard-badge__count">{{ $totalCategories }}</span> Categories</span>
        @endcan
        @can('viewAny', App\Models\User::class)
        <a href="{{ route('users.index') }}" class="dashboard-badge dashboard-badge--neutral"><span class="dashboard-badge__count">{{ $totalUsers }}</span> Users</a>
        @else
        <span class="dashboard-badge dashboard-badge--neutral"><span class="dashboard-badge__count">{{ $totalUsers }}</span> Users</span>
        @endcan
        @can('viewAny', App\Models\DigitalAsset::class)
        <a href="{{ route('digital-assets.index') }}" class="dashboard-badge dashboard-badge--cyan"><span class="dashboard-badge__count">{{ $totalDigitalAssets }}</span> Digital</a>
        @else
        <span class="dashboard-badge dashboard-badge--cyan"><span class="dashboard-badge__count">{{ $totalDigitalAssets }}</span> Digital</span>
        @endcan
    </div>

    {{-- Hero + status pills --}}
    <div class="dashboard-hero">
        <div class="dashboard-hero-main">
            <span class="dashboard-hero-label"><i class="bi bi-box-seam me-1"></i>Total assets</span>
            <span class="dashboard-hero-value">{{ $totalAssets }}</span>
        </div>
        <div class="dashboard-hero-pills">
            @foreach($assetsByStatus as $status => $count)
                @php
                    $statusClass = match($status) {
                        'in_use' => 'dash-pill--success',
                        'in_stock' => 'dash-pill--info',
                        'in_repair' => 'dash-pill--warning',
                        'retired' => 'dash-pill--neutral',
                        'lost' => 'dash-pill--danger',
                        default => 'dash-pill--neutral',
                    };
                @endphp
                @can('viewAny', App\Models\Asset::class)
                <a href="{{ route('assets.index', ['status' => $status]) }}" class="dashboard-pill {{ $statusClass }}">
                    <span class="dashboard-pill-value">{{ $count }}</span>
                    <span class="dashboard-pill-label">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                </a>
                @else
                <span class="dashboard-pill {{ $statusClass }}">
                    <span class="dashboard-pill-value">{{ $count }}</span>
                    <span class="dashboard-pill-label">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                </span>
                @endcan
            @endforeach
            @if($unassignedCount > 0 && auth()->user()->can('viewAny', App\Models\Asset::class))
            <a href="{{ route('assets.index', ['assigned' => '0']) }}" class="dashboard-pill dash-pill--outline">
                <span class="dashboard-pill-value">{{ $unassignedCount }}</span>
                <span class="dashboard-pill-label">Unassigned</span>
            </a>
            @endif
        </div>
    </div>

    {{-- Quick module links --}}
    <div class="dashboard-modules">
        @can('viewAny', App\Models\Asset::class)
        <a href="{{ route('find-assets.index') }}" class="dashboard-module-card">
            <i class="bi bi-search dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Find assets</span>
        </a>
        <a href="{{ route('assets.index') }}" class="dashboard-module-card">
            <i class="bi bi-laptop dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Assets</span>
        </a>
        @endcan
        @can('viewAny', App\Models\AssetCategory::class)
        <a href="{{ route('categories.index') }}" class="dashboard-module-card">
            <i class="bi bi-tags dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Categories</span>
        </a>
        @endcan
        @can('viewAny', App\Models\DigitalAsset::class)
        <a href="{{ route('digital-assets.index') }}" class="dashboard-module-card">
            <i class="bi bi-cloud-check dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Digital assets</span>
        </a>
        @endcan
        @can('viewAny', App\Models\Employee::class)
        <a href="{{ route('employees.index') }}" class="dashboard-module-card">
            <i class="bi bi-person dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Employees</span>
        </a>
        @endcan
        @can('viewAny', App\Models\Department::class)
        <a href="{{ route('departments.index') }}" class="dashboard-module-card">
            <i class="bi bi-building dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Departments</span>
        </a>
        @endcan
        @can('viewAny', App\Models\Room::class)
        <a href="{{ route('rooms.index') }}" class="dashboard-module-card">
            <i class="bi bi-geo-alt dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Rooms</span>
        </a>
        @endcan
        @if(auth()->user()->hasPermission('reports.view'))
        <a href="{{ route('reports.index') }}" class="dashboard-module-card">
            <i class="bi bi-file-earmark-text dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Reports</span>
        </a>
        @endif
        @can('viewAny', App\Models\User::class)
        <a href="{{ route('users.index') }}" class="dashboard-module-card">
            <i class="bi bi-person-badge dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Users</span>
        </a>
        @endcan
        @can('viewAny', App\Models\Role::class)
        <a href="{{ route('roles.index') }}" class="dashboard-module-card">
            <i class="bi bi-shield-lock dashboard-module-card__icon"></i>
            <span class="dashboard-module-card__label">Roles</span>
        </a>
        @endcan
    </div>

    {{-- Charts row (3 charts) --}}
    <div class="dashboard-charts-row dashboard-charts-row--three">
        <div class="dashboard-chart-card" id="dashboard-chart-categories-wrap">
            <div class="corp-card-header"><i class="bi bi-pie-chart me-2"></i>By category <span class="dashboard-chart-hint">(click segment)</span></div>
            <div class="corp-card-body dashboard-chart-body">
                @if($chartCategories->isEmpty())
                    <p class="dashboard-empty mb-0">No categories yet.</p>
                @else
                    <canvas id="chartCategories" height="220" aria-label="Assets by category"></canvas>
                @endif
            </div>
        </div>
        <div class="dashboard-chart-card">
            <div class="corp-card-header"><i class="bi bi-bar-chart me-2"></i>By status</div>
            <div class="corp-card-body dashboard-chart-body">
                @if($chartStatus->isEmpty())
                    <p class="dashboard-empty mb-0">No assets yet.</p>
                @else
                    <canvas id="chartStatus" height="220" aria-label="Assets by status"></canvas>
                @endif
            </div>
        </div>
        <div class="dashboard-chart-card" id="dashboard-chart-rooms-wrap">
            <div class="corp-card-header"><i class="bi bi-geo-alt me-2"></i>By room <span class="dashboard-chart-hint">(click bar)</span></div>
            <div class="corp-card-body dashboard-chart-body">
                @if($chartRooms->isEmpty())
                    <p class="dashboard-empty mb-0">No rooms yet.</p>
                @else
                    <canvas id="chartRooms" height="220" aria-label="Assets by room"></canvas>
                @endif
            </div>
        </div>
    </div>

    {{-- Reports quick links --}}
    @if(auth()->user()->hasPermission('reports.view'))
    <div class="dashboard-reports-strip">
        <span class="dashboard-reports-strip__label"><i class="bi bi-file-earmark-text me-1"></i>Reports:</span>
        <a href="{{ route('reports.show', 'summary') }}" target="_blank" class="dashboard-reports-strip__link">Summary</a>
        <a href="{{ route('reports.show', 'by-category') }}" target="_blank" class="dashboard-reports-strip__link">By category</a>
        <a href="{{ route('reports.show', 'assigned') }}" target="_blank" class="dashboard-reports-strip__link">Assigned</a>
        <a href="{{ route('reports.show', 'warranty') }}" target="_blank" class="dashboard-reports-strip__link">Warranty</a>
        <a href="{{ route('reports.index') }}" class="dashboard-reports-strip__link dashboard-reports-strip__link--all">All reports <i class="bi bi-box-arrow-up-right ms-1"></i></a>
    </div>
    @endif

    {{-- Bottom blocks grid --}}
    <div class="dashboard-bottom-row">
        <section class="dash-block">
            <header class="dash-block__header">
                <i class="bi bi-clock dash-block__icon" aria-hidden="true"></i>
                <h3 class="dash-block__title">Warranty (90d)</h3>
            </header>
            <div class="dash-block__body">
                @if($warrantySoon->isEmpty())
                    <p class="dash-block__empty">None</p>
                @else
                    <div class="dash-block__list" role="list">
                        @foreach($warrantySoon->take(5) as $a)
                            <a href="{{ route('assets.show', $a) }}" class="dash-block__row" role="listitem">
                                <span class="dash-block__label">{{ $a->asset_tag }}</span>
                                <span class="dash-block__badge dash-block__badge--warranty">{{ $a->warranty_expiry->format('M j') }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
        <section class="dash-block">
            <header class="dash-block__header">
                <i class="bi bi-clock-history dash-block__icon" aria-hidden="true"></i>
                <h3 class="dash-block__title">Recently updated</h3>
            </header>
            <div class="dash-block__body">
                @if($recentAssets->isEmpty())
                    <p class="dash-block__empty">No assets yet.</p>
                @else
                    <div class="dash-block__list" role="list">
                        @foreach($recentAssets->take(5) as $a)
                            <a href="{{ route('assets.show', $a) }}" class="dash-block__row" role="listitem">
                                <span class="dash-block__label">{{ $a->asset_tag }}</span>
                                <span class="dash-block__badge dash-block__badge--category">{{ $a->category?->name ?? '—' }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
        <section class="dash-block">
            <header class="dash-block__header">
                <i class="bi bi-box dash-block__icon" aria-hidden="true"></i>
                <h3 class="dash-block__title">Unassigned assets</h3>
            </header>
            <div class="dash-block__body">
                @if($unassignedAssets->isEmpty())
                    <p class="dash-block__empty">None</p>
                @else
                    <div class="dash-block__list" role="list">
                        @foreach($unassignedAssets->take(5) as $a)
                            <a href="{{ route('assets.show', $a) }}" class="dash-block__row" role="listitem">
                                <span class="dash-block__label">{{ $a->asset_tag }}</span>
                                <span class="dash-block__badge dash-block__badge--category">{{ $a->category?->name ?? '—' }}</span>
                            </a>
                        @endforeach
                    </div>
                    @if($unassignedCount > 5 && auth()->user()->can('viewAny', App\Models\Asset::class))
                    <a href="{{ route('assets.index', ['assigned' => '0']) }}" class="dash-block__footer-link">View all {{ $unassignedCount }} unassigned</a>
                    @endif
                @endif
            </div>
        </section>
        <section class="dash-block">
            <header class="dash-block__header">
                <i class="bi bi-wrench dash-block__icon" aria-hidden="true"></i>
                <h3 class="dash-block__title">Recent maintenance</h3>
            </header>
            <div class="dash-block__body">
                @if($maintenanceRecent->isEmpty())
                    <p class="dash-block__empty">No maintenance logs.</p>
                @else
                    <div class="dash-block__list dash-block__list--maintenance" role="list">
                        @foreach($maintenanceRecent->take(5) as $log)
                            <a href="{{ route('assets.show', $log->asset) }}" class="dash-block__row dash-block__row--maintenance" role="listitem">
                                <span class="dash-block__label">{{ $log->asset->asset_tag }}</span>
                                <span class="dash-block__badge dash-block__badge--type">{{ $log->type }}</span>
                                <span class="dash-block__meta">{{ $log->date->format('M j') }} · {{ $log->performedBy?->name ?? '—' }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
        <section class="dash-block">
            <header class="dash-block__header">
                <i class="bi bi-person-check dash-block__icon" aria-hidden="true"></i>
                <h3 class="dash-block__title">Top employees by assets</h3>
            </header>
            <div class="dash-block__body">
                @if($topEmployeesByAssets->isEmpty())
                    <p class="dash-block__empty">No assignments yet.</p>
                @else
                    <div class="dash-block__list" role="list">
                        @foreach($topEmployeesByAssets as $emp)
                            <a href="{{ route('employees.show', $emp) }}" class="dash-block__row" role="listitem">
                                <span class="dash-block__label">{{ $emp->name }}</span>
                                <span class="dash-block__badge dash-block__badge--type">{{ $emp->assets_count }} asset{{ $emp->assets_count !== 1 ? 's' : '' }}</span>
                                @if($emp->department)
                                <span class="dash-block__meta">{{ $emp->department->name }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
        <section class="dash-block">
            <header class="dash-block__header">
                <i class="bi bi-building dash-block__icon" aria-hidden="true"></i>
                <h3 class="dash-block__title">Departments</h3>
            </header>
            <div class="dash-block__body">
                @if($totalDepartments->isEmpty())
                    <p class="dash-block__empty">No departments yet.</p>
                @else
                    <div class="dash-block__list" role="list">
                        @foreach($totalDepartments->take(8) as $dept)
                            <a href="{{ route('departments.show', $dept) }}" class="dash-block__row" role="listitem">
                                <span class="dash-block__label">{{ $dept->name }}</span>
                                <span class="dash-block__badge dash-block__badge--category">{{ $dept->employees_count }} employee{{ $dept->employees_count !== 1 ? 's' : '' }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function() {
    const statusColors = {
        in_use: '#107c10',
        in_stock: '#0078d4',
        in_repair: '#ff8c00',
        retired: '#5c5c5c',
        lost: '#d13438'
    };
    const categoryPalette = ['#0078d4', '#107c10', '#ff8c00', '#5c5c5c', '#8764b8', '#00b7c3', '#d13438', '#e81123'];

    const categoriesData = @json($chartCategories);
    const statusData = @json($chartStatus);
    const roomsData = @json($chartRooms);
    const assetsIndexUrl = @json(route('assets.index'));
    const canViewAssets = @json(auth()->user()->can('viewAny', App\Models\Asset::class));
    const roomsIndexUrl = @json(route('rooms.index'));

    if (categoriesData.length && document.getElementById('chartCategories')) {
        const ctx = document.getElementById('chartCategories').getContext('2d');
        const chartCategories = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: categoriesData.map(d => d.name),
                datasets: [{
                    data: categoriesData.map(d => d.count),
                    backgroundColor: categoryPalette.slice(0, categoriesData.length),
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: { padding: { right: 8 } },
                plugins: {
                    legend: { position: 'right', labels: { boxWidth: 12, padding: 10, font: { size: 11 } } },
                    tooltip: { enabled: true }
                },
                cutout: '62%',
                onClick: (e, el) => {
                    if (el.length && canViewAssets && categoriesData[el[0].index]) {
                        const cat = categoriesData[el[0].index];
                        window.location.href = assetsIndexUrl + '?category_id=' + cat.id;
                    }
                }
            }
        });
    }

    if (statusData.length && document.getElementById('chartStatus')) {
        new Chart(document.getElementById('chartStatus'), {
            type: 'bar',
            data: {
                labels: statusData.map(d => d.label),
                datasets: [{
                    data: statusData.map(d => d.count),
                    backgroundColor: statusData.map(d => statusColors[d.status] || '#5c5c5c'),
                    borderRadius: 4,
                    borderSkipped: false
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    x: { beginAtZero: true, grid: { display: false }, ticks: { font: { size: 11 } } },
                    y: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });
    }

    if (roomsData.length && document.getElementById('chartRooms')) {
        const ctxRooms = document.getElementById('chartRooms').getContext('2d');
        new Chart(ctxRooms, {
            type: 'bar',
            data: {
                labels: roomsData.map(d => d.name),
                datasets: [{
                    data: roomsData.map(d => d.count),
                    backgroundColor: '#0078d4',
                    borderRadius: 4,
                    borderSkipped: false
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                onClick: (e, el) => {
                    if (el.length && roomsData[el[0].index]) {
                        const room = roomsData[el[0].index];
                        window.location.href = assetsIndexUrl + '?room_id=' + room.id;
                    }
                },
                scales: {
                    x: { beginAtZero: true, grid: { display: false }, ticks: { font: { size: 11 } } },
                    y: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    }
})();
</script>
@endpush
@endsection
