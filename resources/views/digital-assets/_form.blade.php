@php
    $da = $digitalAsset ?? null;
    $val = fn ($key, $default = '') => old($key, $da ? $da->$key : $default);
@endphp
<div class="corp-card mb-3">
    <div class="corp-card-header"><i class="bi bi-tag me-2"></i>Basic info</div>
    <div class="corp-card-body">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $val('name') }}" required placeholder="e.g. Microsoft 365 E3">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Type <span class="text-danger">*</span></label>
                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                    @foreach(\App\Models\DigitalAsset::typeOptions() as $value => $label)
                        <option value="{{ $value }}" @selected($val('type', 'subscription') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Vendor</label>
                <input type="text" name="vendor" class="form-control @error('vendor') is-invalid @enderror" value="{{ $val('vendor') }}" placeholder="e.g. Microsoft">
                @error('vendor')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Product name</label>
                <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ $val('product_name') }}" placeholder="e.g. Office 365 E3">
                @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">SKU / Product ID</label>
                <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ $val('sku') }}" placeholder="e.g. WIN10-PRO">
                @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ $val('category') }}" placeholder="e.g. Productivity, Security">
                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Short description">{{ $val('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="corp-card mb-3">
    <div class="corp-card-header"><i class="bi bi-key me-2"></i>License & status</div>
    <div class="corp-card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">License key / Reference</label>
                <input type="text" name="license_key_reference" class="form-control @error('license_key_reference') is-invalid @enderror" value="{{ $val('license_key_reference') }}" placeholder="Masked key or reference ID">
                @error('license_key_reference')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    @foreach(\App\Models\DigitalAsset::statusOptions() as $value => $label)
                        <option value="{{ $value }}" @selected($val('status', 'active') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="corp-card mb-3">
    <div class="corp-card-header"><i class="bi bi-calendar3 me-2"></i>Dates</div>
    <div class="corp-card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Start date</label>
                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ $da?->start_date?->format('Y-m-d') ?? old('start_date') }}">
                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">End date</label>
                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ $da?->end_date?->format('Y-m-d') ?? old('end_date') }}">
                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Renewal date</label>
                <input type="date" name="renewal_date" class="form-control @error('renewal_date') is-invalid @enderror" value="{{ $da?->renewal_date?->format('Y-m-d') ?? old('renewal_date') }}">
                @error('renewal_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Next billing date</label>
                <input type="date" name="next_billing_date" class="form-control @error('next_billing_date') is-invalid @enderror" value="{{ $da?->next_billing_date?->format('Y-m-d') ?? old('next_billing_date') }}">
                @error('next_billing_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="corp-card mb-3">
    <div class="corp-card-header"><i class="bi bi-currency-dollar me-2"></i>Billing & quantity</div>
    <div class="corp-card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Billing cycle</label>
                <select name="billing_cycle" class="form-select @error('billing_cycle') is-invalid @enderror">
                    <option value="">—</option>
                    @foreach(\App\Models\DigitalAsset::billingCycleOptions() as $value => $label)
                        <option value="{{ $value }}" @selected($val('billing_cycle') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('billing_cycle')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Cost</label>
                <input type="number" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ $val('cost') }}" step="0.01" min="0" placeholder="0.00">
                @error('cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label class="form-label">Currency</label>
                <input type="text" name="currency" class="form-control @error('currency') is-invalid @enderror" value="{{ $val('currency', 'USD') }}" maxlength="3" placeholder="USD">
                @error('currency')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label class="form-label">Quantity (seats)</label>
                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ $val('quantity', 1) }}" min="1">
                @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="auto_renew" value="1" class="form-check-input" id="auto_renew" @checked($val('auto_renew') || ($da && $da->auto_renew))>
                    <label class="form-check-label" for="auto_renew">Auto-renew</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="corp-card mb-3">
    <div class="corp-card-header"><i class="bi bi-link-45deg me-2"></i>Links & notes</div>
    <div class="corp-card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Terms / Agreement URL</label>
                <input type="url" name="terms_url" class="form-control @error('terms_url') is-invalid @enderror" value="{{ $val('terms_url') }}" placeholder="https://...">
                @error('terms_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Portal / Admin URL</label>
                <input type="url" name="portal_url" class="form-control @error('portal_url') is-invalid @enderror" value="{{ $val('portal_url') }}" placeholder="https://...">
                @error('portal_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Notes</label>
                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ $val('notes') }}</textarea>
                @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
