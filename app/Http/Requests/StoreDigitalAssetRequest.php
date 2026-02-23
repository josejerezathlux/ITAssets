<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDigitalAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\DigitalAsset::class);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:license,subscription,saas,maintenance,support_contract,other',
            'vendor' => 'nullable|string|max:255',
            'product_name' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'license_key_reference' => 'nullable|string|max:255',
            'status' => 'required|in:active,trial,pending_renewal,expired,cancelled,suspended',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'renewal_date' => 'nullable|date',
            'next_billing_date' => 'nullable|date',
            'billing_cycle' => 'nullable|in:one_time,monthly,quarterly,annually,biennially,custom',
            'cost' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'quantity' => 'nullable|integer|min:1',
            'auto_renew' => 'nullable|boolean',
            'terms_url' => 'nullable|url|max:500',
            'portal_url' => 'nullable|url|max:500',
            'category' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('auto_renew')) {
            $this->merge(['auto_renew' => $this->boolean('auto_renew')]);
        }
    }
}
