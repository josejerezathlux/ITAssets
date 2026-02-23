@extends('layouts.app')

@section('title', $asset->asset_tag)

@section('content')
@php
    $currentAssignment = $asset->assignments->whereNull('checked_in_at')->first();
    $assignmentHistory = $asset->assignments->sortByDesc('checked_out_at')->take(8)->values();
    $statusBadge = match($asset->status) {
        'in_use' => 'fluent-badge-success',
        'in_stock' => 'fluent-badge-info',
        'in_repair' => 'fluent-badge-warning',
        'retired' => 'fluent-badge-neutral',
        'lost' => 'fluent-badge-danger',
        default => 'fluent-badge-neutral',
    };
@endphp
<div class="asset-show">
    <div class="fluent-info-card fluent-dismissible mb-3" data-dismiss-key="asset-show-info">
        <i class="bi bi-info-circle-fill fluent-info-icon"></i>
        <div class="fluent-info-body">
            <div class="fluent-info-title">Asset details</div>
            <p class="mb-0 small">View and edit this asset, check assignment history, and add maintenance logs.</p>
        </div>
        <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="corp-page-header">
        <div class="d-flex flex-column gap-1">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <h1 class="corp-page-title mb-0"><i class="bi bi-laptop me-2"></i>{{ $asset->asset_tag }}</h1>
                <span class="badge fluent-badge-primary"><i class="bi bi-tags"></i> {{ $asset->category?->name }}</span>
                <span class="badge {{ $statusBadge }}">{{ ucfirst(str_replace('_', ' ', $asset->status)) }}</span>
            </div>
            <div class="asset-assignment-badge">
                @if($asset->assignedEmployee)
                    <span class="text-muted small">Assigned to</span>
@can('viewAny', App\Models\Employee::class)
                                                <a href="{{ route('employees.show', $asset->assignedEmployee) }}" class="corp-link">{{ $asset->assignedEmployee->name }}</a>
                                            @else
                                                <span>{{ $asset->assignedEmployee->name }}</span>
                    @endcan
                @else
                    <span class="text-muted small">Available — not assigned</span>
                @endif
            </div>
        </div>
        <div class="d-flex gap-2 align-items-center flex-wrap">
            <span class="asset-qr-soon btn btn-outline-secondary disabled position-relative" aria-disabled="true" title="QR code coming soon">
                <i class="bi bi-qr-code me-1"></i>QR code
                <span class="badge badge-soon">Soon</span>
            </span>
            @can('update', $asset)
                <a href="{{ route('assets.edit', $asset) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i>Edit</a>
            @endcan
            @can('delete', $asset)
                <form method="POST" action="{{ route('assets.destroy', $asset) }}" class="d-inline" onsubmit="return confirm('Delete this asset?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </form>
            @endcan
            <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back to list</a>
        </div>
    </div>

    <ul class="asset-show-tabs nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#overview"><i class="bi bi-grid me-1"></i>Overview</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#dynamic"><i class="bi bi-list-check me-1"></i>Dynamic fields</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#attachments"><i class="bi bi-paperclip me-1"></i>Attachments</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#maintenance"><i class="bi bi-wrench me-1"></i>Maintenance</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#history"><i class="bi bi-clock-history me-1"></i>Activity log</a></li>
    </ul>

    <div class="tab-content asset-show-tab-content">
        <div class="tab-pane fade show active" id="overview">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="corp-card h-100">
                        <div class="corp-card-header"><i class="bi bi-info-square me-2"></i>Details</div>
                        <div class="corp-card-body p-0">
                            <dl class="asset-detail-list">
                                <div class="asset-detail-row"><dt>Serial number</dt><dd>{{ $asset->serial_number ?? '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Make / Model</dt><dd>{{ $asset->make ?? '—' }} {{ $asset->model ? ' / ' . $asset->model : '' }}</dd></div>
                                <div class="asset-detail-row"><dt>Purchase date</dt><dd>{{ $asset->purchase_date?->format('M j, Y') ?? '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Vendor</dt><dd>{{ $asset->vendor ?? '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Cost</dt><dd>{{ $asset->cost !== null ? number_format($asset->cost, 2) : '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Warranty expiry</dt><dd>{{ $asset->warranty_expiry?->format('M j, Y') ?? '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Condition</dt><dd>{{ $asset->condition ?? '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Room</dt><dd>{{ $asset->room?->name ?? '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Assigned to</dt><dd>{{ $asset->assignedEmployee?->name ?? '—' }}</dd></div>
                                <div class="asset-detail-row"><dt>Notes</dt><dd>{{ $asset->notes ? nl2br(e($asset->notes)) : '—' }}</dd></div>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="corp-card">
                        <div class="corp-card-header"><i class="bi bi-person-badge me-2"></i>Who has this asset?</div>
                        <div class="corp-card-body">
                            @if($asset->assignedEmployee)
                                <div class="asset-assignee-card">
                                    <div class="asset-assignee-info">
                                        <div class="asset-assignee-name">
                                            @can('viewAny', App\Models\Employee::class)
                                                <a href="{{ route('employees.show', $asset->assignedEmployee) }}" class="corp-link">{{ $asset->assignedEmployee->name }}</a>
                                            @else
                                                {{ $asset->assignedEmployee->name }}
                                            @endcan
                                        </div>
                                        @if($asset->assignedEmployee->department || $asset->assignedEmployee->email)
                                            <div class="asset-assignee-meta">
                                                @if($asset->assignedEmployee->department)<span>{{ $asset->assignedEmployee->department->name }}</span>@endif
                                                @if($asset->assignedEmployee->email)<span>{{ $asset->assignedEmployee->email }}</span>@endif
                                                @if($asset->assignedEmployee->phone)<span>{{ $asset->assignedEmployee->phone }}</span>@endif
                                            </div>
                                        @endif
                                        @if($currentAssignment)
                                            <div class="asset-assignee-since text-muted small">Assigned since {{ $currentAssignment->checked_out_at->format('M j, Y') }}</div>
                                        @endif
                                    </div>
                                    @if(auth()->user()->hasPermission('assets.assign'))
                                    <div class="asset-assignee-actions">
                                        <p class="small text-muted mb-2">Return this asset to stock so it can be assigned to someone else.</p>
                                        <form method="POST" action="{{ route('assets.check-in', $asset) }}" class="asset-assign-form">
                                            @csrf
                                            <input type="text" name="notes" class="form-control form-control-sm mb-2" placeholder="Notes (optional)">
                                            <button type="submit" class="btn btn-success btn-sm">Return to stock</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <div class="asset-assignee-card asset-assignee-card--empty">
                                    <p class="mb-0 text-muted">This asset is <strong>available</strong>. No one is assigned to it right now.</p>
                                    @if(auth()->user()->hasPermission('assets.assign'))
                                    <p class="small text-muted mt-2 mb-2">Assign it to an employee so they can use it.</p>
                                    <form method="POST" action="{{ route('assets.check-out', $asset) }}" class="asset-assign-form">
                                        @csrf
                                        <label class="form-label small">Choose employee</label>
                                        <select name="employee_id" class="form-select form-select-sm mb-2" required>
                                            <option value="">Select who will use this asset…</option>
                                            @foreach(\App\Models\Employee::orderBy('name')->get() as $e)
                                                <option value="{{ $e->id }}">{{ $e->name }}@if($e->department) ({{ $e->department->name }})@endif</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="notes" class="form-control form-control-sm mb-2" placeholder="Notes (optional)">
                                        <button type="submit" class="btn btn-primary btn-sm">Assign to this person</button>
                                    </form>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @if($assignmentHistory->isNotEmpty())
                    <div class="corp-card mt-4">
                        <div class="corp-card-header"><i class="bi bi-journal-check me-2"></i>Assignment history</div>
                        <div class="corp-card-body p-0">
                            <ul class="asset-assignment-history">
                                @foreach($assignmentHistory as $a)
                                    <li>
                                        <span class="asset-assignment-who">{{ $a->employee?->name ?? '—' }}</span>
                                        <span class="text-muted small">{{ $a->checked_out_at->format('M j, Y') }}</span>
                                        @if($a->checked_in_at)
                                            <span class="text-muted small">– {{ $a->checked_in_at->format('M j, Y') }}</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-25 text-success small">Current</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="dynamic">
            <div class="corp-card">
                <div class="corp-card-header"><i class="bi bi-list-check me-2"></i>Category-specific fields</div>
                <div class="corp-card-body {{ $asset->fields->isNotEmpty() ? 'p-0' : '' }}">
                    @if($asset->fields->isNotEmpty())
                        <dl class="asset-detail-list mb-0">
                            @foreach($asset->fields as $fv)
                                <div class="asset-detail-row"><dt>{{ $fv->field->name }}</dt><dd>{{ $fv->value }}</dd></div>
                            @endforeach
                        </dl>
                    @else
                        <p class="text-muted mb-0">No dynamic fields or no values set.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="attachments">
            <div class="corp-card">
                <div class="corp-card-header"><i class="bi bi-paperclip me-2"></i>Attachments</div>
                <div class="corp-card-body">
                    @if(auth()->user()->hasPermission('assets.upload_attachment'))
                    <form method="POST" action="{{ route('assets.attachments.store', $asset) }}" enctype="multipart/form-data" class="d-flex flex-wrap gap-2 align-items-end mb-4">
                        @csrf
                        <div class="flex-grow-1 min-width-200">
                            <label class="form-label small mb-1">Upload file</label>
                            <input type="file" name="file" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png,.gif">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                    </form>
                    @endif
                    @forelse($asset->attachments as $att)
                        <div class="asset-attachment-row">
                            <div>
                                <a href="{{ asset('storage/'.$att->path) }}" class="corp-link" target="_blank">{{ $att->filename }}</a>
                                <small class="text-muted ms-2">{{ number_format($att->size / 1024, 1) }} KB</small>
                            </div>
                            @if(auth()->user()->hasPermission('assets.delete_attachment'))
                                <form method="POST" action="{{ route('assets.attachments.destroy', [$asset, $att]) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this file?');">Remove</button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted mb-0">No attachments.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="maintenance">
            <div class="corp-card">
                <div class="corp-card-header"><i class="bi bi-wrench-adjustable me-2"></i>Maintenance logs</div>
                <div class="corp-card-body">
                    @if(auth()->user()->hasPermission('assets.maintenance'))
                    <form method="POST" action="{{ route('assets.maintenance.store', $asset) }}" enctype="multipart/form-data" class="asset-maintenance-form mb-4">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2"><label class="form-label small mb-1">Date</label><input type="date" name="date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required></div>
                            <div class="col-md-2"><label class="form-label small mb-1">Type</label><select name="type" class="form-select form-select-sm"><option value="repair">Repair</option><option value="upgrade">Upgrade</option><option value="inspection">Inspection</option></select></div>
                            <div class="col-md-3"><label class="form-label small mb-1">Notes</label><input type="text" name="notes" class="form-control form-control-sm"></div>
                            <div class="col-md-2"><label class="form-label small mb-1">File</label><input type="file" name="attachment" class="form-control form-control-sm"></div>
                            <div class="col-md-2"><button type="submit" class="btn btn-primary btn-sm w-100">Add log</button></div>
                        </div>
                    </form>
                    @endif
                    <div class="table-responsive">
                        <table class="table corp-table align-middle mb-0">
                            <thead>
                                <tr><th>Date</th><th>Type</th><th>Performed by</th><th>Notes</th></tr>
                            </thead>
                            <tbody>
                                @forelse($asset->maintenanceLogs as $log)
                                    <tr>
                                        <td>{{ $log->date->format('M j, Y') }}</td>
                                        <td>{{ ucfirst($log->type) }}</td>
                                        <td>{{ $log->performedBy?->name ?? '—' }}</td>
                                        <td>{{ $log->notes ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-muted text-center py-4">No maintenance logs.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="history">
            <div class="corp-card">
                <div class="corp-card-header"><i class="bi bi-clock-history me-2"></i>Activity log</div>
                <div class="corp-card-body p-0">
                    <div class="table-responsive">
                        <table class="table corp-table align-middle mb-0">
                            <thead>
                                <tr><th>When</th><th>Event</th><th>User</th></tr>
                            </thead>
                            <tbody>
                                @forelse($asset->activityLogs as $log)
                                    <tr>
                                        <td>{{ $log->created_at->format('M j, Y H:i') }}</td>
                                        <td>{{ $log->event_label }}</td>
                                        <td>{{ $log->user?->name ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-muted text-center py-4">No activity yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
