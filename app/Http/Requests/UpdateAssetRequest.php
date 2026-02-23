<?php

namespace App\Http\Requests;

use App\Models\Asset;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('asset'));
    }

    public function rules(): array
    {
        $asset = $this->route('asset');
        return [
            'asset_tag' => 'required|string|max:255|unique:assets,asset_tag,' . $asset->id,
            'asset_category_id' => 'required|exists:asset_categories,id',
            'serial_number' => 'nullable|string|max:255',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'vendor' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric|min:0',
            'warranty_expiry' => 'nullable|date',
            'status' => 'required|in:in_use,in_stock,in_repair,retired,lost',
            'condition' => 'nullable|string|max:255',
            'room_id' => 'nullable|exists:rooms,id',
            'assigned_employee_id' => 'nullable|exists:employees,id',
            'notes' => 'nullable|string',
            'dynamic_fields' => 'array',
            'dynamic_fields.*' => 'nullable',
        ];
    }
}
