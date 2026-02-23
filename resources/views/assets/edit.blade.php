@extends('layouts.app')

@section('title', 'Edit ' . $asset->asset_tag)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">Edit {{ $asset->asset_tag }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('assets.show', $asset) }}" class="btn btn-outline-secondary">View</a>
        <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<form method="POST" action="{{ route('assets.update', $asset) }}">
    @csrf
    @method('PUT')
    <div class="card mb-3">
        <div class="card-header">Basic info</div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label">Asset tag *</label>
                    <input type="text" name="asset_tag" class="form-control @error('asset_tag') is-invalid @enderror" value="{{ old('asset_tag', $asset->asset_tag) }}" required>
                    @error('asset_tag')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category *</label>
                    <select name="asset_category_id" id="asset_category_id" class="form-select" required>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" @selected(old('asset_category_id', $asset->asset_category_id) == $c->id)>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Serial number</label>
                    <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number', $asset->serial_number) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Make</label>
                    <input type="text" name="make" class="form-control" value="{{ old('make', $asset->make) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Model</label>
                    <input type="text" name="model" class="form-control" value="{{ old('model', $asset->model) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach(['in_stock','in_use','in_repair','retired','lost'] as $s)
                            <option value="{{ $s }}" @selected(old('status', $asset->status) === $s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Purchase date</label>
                    <input type="date" name="purchase_date" class="form-control" value="{{ old('purchase_date', $asset->purchase_date?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Vendor</label>
                    <input type="text" name="vendor" class="form-control" value="{{ old('vendor', $asset->vendor) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cost</label>
                    <input type="number" name="cost" class="form-control" step="0.01" min="0" value="{{ old('cost', $asset->cost) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Warranty expiry</label>
                    <input type="date" name="warranty_expiry" class="form-control" value="{{ old('warranty_expiry', $asset->warranty_expiry?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Condition</label>
                    <input type="text" name="condition" class="form-control" value="{{ old('condition', $asset->condition) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Room</label>
                    <select name="room_id" class="form-select">
                        <option value="">—</option>
                        @foreach($rooms as $r)
                            <option value="{{ $r->id }}" @selected(old('room_id', $asset->room_id) == $r->id)>{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Assigned to</label>
                    <select name="assigned_employee_id" class="form-select">
                        <option value="">—</option>
                        @foreach($employees as $e)
                            <option value="{{ $e->id }}" @selected(old('assigned_employee_id', $asset->assigned_employee_id) == $e->id)>{{ $e->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2">{{ old('notes', $asset->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Category-specific fields</div>
        <div class="card-body">
            @php $fieldValues = $asset->fields->keyBy('asset_field_id'); @endphp
            @foreach($asset->category->fields as $f)
                <div class="mb-2">
                    <label class="form-label">{{ $f->name }}</label>
                    @if($f->input_type === 'select' && $f->options)
                        <select name="dynamic_fields[{{ $f->id }}]" class="form-select">
                            <option value="">—</option>
                            @foreach($f->options as $o)
                                <option value="{{ $o }}" @selected(($fieldValues[$f->id]->value ?? '') === $o)>{{ $o }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="{{ $f->input_type === 'number' ? 'number' : 'text' }}" name="dynamic_fields[{{ $f->id }}]" class="form-control" value="{{ old('dynamic_fields.'.$f->id, $fieldValues[$f->id]->value ?? '') }}">
                    @endif
                </div>
            @endforeach
            @if($asset->category->fields->isEmpty())
                <p class="text-muted small mb-0">No extra fields for this category.</p>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save changes</button>
    <a href="{{ route('assets.show', $asset) }}" class="btn btn-cancel">Cancel</a>
</form>
@endsection
