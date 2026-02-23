@extends('layouts.app')

@section('title', 'New Asset')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">New Asset</h1>
    <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary">Back to list</a>
</div>

<form method="POST" action="{{ route('assets.store') }}">
    @csrf
    <div class="card mb-3">
        <div class="card-header">Basic info</div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label">Asset tag *</label>
                    <input type="text" name="asset_tag" class="form-control @error('asset_tag') is-invalid @enderror" value="{{ old('asset_tag') }}" required>
                    @error('asset_tag')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category *</label>
                    <select name="asset_category_id" id="asset_category_id" class="form-select @error('asset_category_id') is-invalid @enderror" required>
                        <option value="">Select</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" @selected(old('asset_category_id') == $c->id)>{{ $c->name }}</option>
                        @endforeach
                    </select>
                    @error('asset_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Serial number</label>
                    <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Make</label>
                    <input type="text" name="make" class="form-control" value="{{ old('make') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Model</label>
                    <input type="text" name="model" class="form-control" value="{{ old('model') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach(['in_stock','in_use','in_repair','retired','lost'] as $s)
                            <option value="{{ $s }}" @selected(old('status', 'in_stock') === $s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Purchase date</label>
                    <input type="date" name="purchase_date" class="form-control" value="{{ old('purchase_date') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Vendor</label>
                    <input type="text" name="vendor" class="form-control" value="{{ old('vendor') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cost</label>
                    <input type="number" name="cost" class="form-control" step="0.01" min="0" value="{{ old('cost') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Warranty expiry</label>
                    <input type="date" name="warranty_expiry" class="form-control" value="{{ old('warranty_expiry') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Condition</label>
                    <input type="text" name="condition" class="form-control" value="{{ old('condition') }}" placeholder="e.g. Good">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Room</label>
                    <select name="room_id" class="form-select">
                        <option value="">—</option>
                        @foreach($rooms as $r)
                            <option value="{{ $r->id }}" @selected(old('room_id') == $r->id)>{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Assigned to</label>
                    <select name="assigned_employee_id" class="form-select">
                        <option value="">—</option>
                        @foreach($employees as $e)
                            <option value="{{ $e->id }}" @selected(old('assigned_employee_id') == $e->id)>{{ $e->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" id="dynamic-fields-card">
        <div class="card-header">Category-specific fields</div>
        <div class="card-body" id="dynamic-fields-container">
            <p class="text-muted small">Select a category to show extra fields.</p>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create asset</button>
<<<<<<< HEAD
    <a href="{{ route('assets.index') }}" class="btn btn-link">Cancel</a>
=======
    <a href="{{ route('assets.index') }}" class="btn btn-cancel">Cancel</a>
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
</form>

@push('scripts')
<script>
const categoryFields = @json($categoryFieldsForJs);

document.getElementById('asset_category_id').addEventListener('change', function() {
    const catId = this.value;
    const container = document.getElementById('dynamic-fields-container');
    container.innerHTML = '';
    if (!catId || !categoryFields[catId] || !categoryFields[catId].length) {
        container.innerHTML = '<p class="text-muted small">No extra fields for this category.</p>';
        return;
    }
    categoryFields[catId].forEach(f => {
        const div = document.createElement('div');
        div.className = 'mb-2';
        const label = document.createElement('label');
        label.className = 'form-label';
        label.textContent = f.name;
        const name = 'dynamic_fields[' + f.id + ']';
        let input;
        if (f.input_type === 'select' && f.options && f.options.length) {
            input = document.createElement('select');
            input.name = name;
            input.className = 'form-select';
            input.innerHTML = '<option value="">—</option>' + f.options.map(o => '<option value="'+o+'" '+(f.value === o ? 'selected' : '')+'>'+o+'</option>').join('');
        } else {
            input = document.createElement('input');
            input.type = f.input_type === 'number' ? 'number' : 'text';
            input.name = name;
            input.className = 'form-control';
            input.value = f.value || '';
        }
        div.appendChild(label);
        div.appendChild(input);
        container.appendChild(div);
    });
});
document.getElementById('asset_category_id').dispatchEvent(new Event('change'));
</script>
@endpush
@endsection
