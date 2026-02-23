@extends('layouts.app')

@section('title', $digitalAsset->name)

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-cloud-check me-2"></i>{{ $digitalAsset->name }}</h2>
        <p class="text-muted small mb-0">
            <span class="badge {{ $digitalAsset->status === 'active' ? 'fluent-badge-success' : ($digitalAsset->status === 'expired' || $digitalAsset->status === 'cancelled' ? 'fluent-badge-danger' : 'fluent-badge-warning') }}">{{ \App\Models\DigitalAsset::statusOptions()[$digitalAsset->status] ?? $digitalAsset->status }}</span>
            <span class="badge fluent-badge-neutral ms-1">{{ \App\Models\DigitalAsset::typeOptions()[$digitalAsset->type] ?? $digitalAsset->type }}</span>
            @if($digitalAsset->category)<span class="badge fluent-badge-info ms-1">{{ $digitalAsset->category }}</span>@endif
        </p>
    </div>
    <div class="d-flex gap-2">
        @can('update', $digitalAsset)
            <a href="{{ route('digital-assets.edit', $digitalAsset) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $digitalAsset)
            <form method="POST" action="{{ route('digital-assets.destroy', $digitalAsset) }}" class="d-inline" onsubmit="return confirm('Delete this digital asset?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        @endcan
        <a href="{{ route('digital-assets.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="corp-card mb-3">
            <div class="corp-card-header"><i class="bi bi-tag me-2"></i>Basic info</div>
            <div class="corp-card-body">
                <dl class="row mb-0">
                    @if($digitalAsset->vendor)<dt class="col-sm-3 text-muted">Vendor</dt><dd class="col-sm-9">{{ $digitalAsset->vendor }}</dd>@endif
                    @if($digitalAsset->product_name)<dt class="col-sm-3 text-muted">Product</dt><dd class="col-sm-9">{{ $digitalAsset->product_name }}</dd>@endif
                    @if($digitalAsset->sku)<dt class="col-sm-3 text-muted">SKU</dt><dd class="col-sm-9"><code>{{ $digitalAsset->sku }}</code></dd>@endif
                    @if($digitalAsset->description)<dt class="col-sm-3 text-muted">Description</dt><dd class="col-sm-9">{{ $digitalAsset->description }}</dd>@endif
                </dl>
            </div>
        </div>

        <div class="corp-card mb-3">
            <div class="corp-card-header"><i class="bi bi-calendar3 me-2"></i>Dates & billing</div>
            <div class="corp-card-body">
                <dl class="row mb-0">
                    @if($digitalAsset->start_date)<dt class="col-sm-4 text-muted">Start date</dt><dd class="col-sm-8">{{ $digitalAsset->start_date->format('M j, Y') }}</dd>@endif
                    @if($digitalAsset->end_date)<dt class="col-sm-4 text-muted">End date</dt><dd class="col-sm-8">{{ $digitalAsset->end_date->format('M j, Y') }}</dd>@endif
                    @if($digitalAsset->renewal_date)<dt class="col-sm-4 text-muted">Renewal date</dt><dd class="col-sm-8">{{ $digitalAsset->renewal_date->format('M j, Y') }}</dd>@endif
                    @if($digitalAsset->next_billing_date)<dt class="col-sm-4 text-muted">Next billing</dt><dd class="col-sm-8">{{ $digitalAsset->next_billing_date->format('M j, Y') }}</dd>@endif
                    @if($digitalAsset->billing_cycle)<dt class="col-sm-4 text-muted">Billing cycle</dt><dd class="col-sm-8">{{ \App\Models\DigitalAsset::billingCycleOptions()[$digitalAsset->billing_cycle] ?? $digitalAsset->billing_cycle }}</dd>@endif
                    @if($digitalAsset->cost !== null)<dt class="col-sm-4 text-muted">Cost</dt><dd class="col-sm-8">{{ number_format($digitalAsset->cost, 2) }} {{ $digitalAsset->currency }}</dd>@endif
                    <dt class="col-sm-4 text-muted">Auto-renew</dt><dd class="col-sm-8">{{ $digitalAsset->auto_renew ? 'Yes' : 'No' }}</dd>
                </dl>
            </div>
        </div>

        @if($digitalAsset->notes || $digitalAsset->terms_url || $digitalAsset->portal_url)
        <div class="corp-card mb-3">
            <div class="corp-card-header"><i class="bi bi-link-45deg me-2"></i>Links & notes</div>
            <div class="corp-card-body">
                <dl class="row mb-0">
                    @if($digitalAsset->terms_url)<dt class="col-sm-3 text-muted">Terms</dt><dd class="col-sm-9"><a href="{{ $digitalAsset->terms_url }}" target="_blank" rel="noopener">{{ $digitalAsset->terms_url }}</a></dd>@endif
                    @if($digitalAsset->portal_url)<dt class="col-sm-3 text-muted">Portal</dt><dd class="col-sm-9"><a href="{{ $digitalAsset->portal_url }}" target="_blank" rel="noopener">{{ $digitalAsset->portal_url }}</a></dd>@endif
                    @if($digitalAsset->notes)<dt class="col-sm-3 text-muted">Notes</dt><dd class="col-sm-9">{{ $digitalAsset->notes }}</dd>@endif
                </dl>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="corp-card mb-3">
            <div class="corp-card-header"><i class="bi bi-people me-2"></i>Seats</div>
            <div class="corp-card-body">
                <p class="mb-0"><strong>{{ $digitalAsset->assignments_count }}</strong> of <strong>{{ $digitalAsset->quantity }}</strong> assigned</p>
                <p class="small text-muted mb-0 mt-1">{{ $digitalAsset->quantity - $digitalAsset->assignments_count }} available</p>
            </div>
        </div>

        @can('assign', $digitalAsset)
        @if($digitalAsset->assignments_count < $digitalAsset->quantity && $employees->isNotEmpty())
        <div class="corp-card mb-3">
            <div class="corp-card-header"><i class="bi bi-person-plus me-2"></i>Assign seat</div>
            <div class="corp-card-body">
                <form method="POST" action="{{ route('digital-assets.assign', $digitalAsset) }}" class="d-flex gap-2 flex-wrap">
                    @csrf
                    <select name="employee_id" class="form-select form-select-sm" style="min-width: 12rem;" required>
                        <option value="">Choose employee…</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}{{ $emp->department ? ' · ' . $emp->department->name : '' }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Assign</button>
                </form>
            </div>
        </div>
        @endif
        @endcan

        @if($digitalAsset->license_key_reference)
        <div class="corp-card mb-3">
            <div class="corp-card-header"><i class="bi bi-key me-2"></i>License reference</div>
            <div class="corp-card-body">
                <code class="small">{{ $digitalAsset->license_key_reference }}</code>
            </div>
        </div>
        @endif

        <div class="corp-card">
            <div class="corp-card-header"><i class="bi bi-person-check me-2"></i>Assigned to</div>
            @if($digitalAsset->assignments->isEmpty())
                <div class="corp-card-body">
                    <p class="text-muted small mb-0">No seats assigned yet.</p>
                </div>
            @else
                <div class="corp-card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($digitalAsset->assignments as $a)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ $a->assignable_type === \App\Models\Employee::class ? route('employees.show', $a->assignable) : '#' }}" class="corp-link">{{ $a->assignable?->name ?? 'Unknown' }}</a>
                                    <span class="badge fluent-badge-neutral ms-1">{{ class_basename($a->assignable_type) }}</span>
                                </div>
                                @can('assign', $digitalAsset)
                                <form method="POST" action="{{ route('digital-assets.unassign', [$digitalAsset, $a]) }}" class="d-inline" onsubmit="return confirm('Remove this assignment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0" aria-label="Unassign">Unassign</button>
                                </form>
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
