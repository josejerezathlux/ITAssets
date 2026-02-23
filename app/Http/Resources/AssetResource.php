<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'asset_tag' => $this->asset_tag,
            'category' => $this->whenLoaded('category', fn () => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ]),
            'serial_number' => $this->serial_number,
            'make' => $this->make,
            'model' => $this->model,
            'purchase_date' => $this->purchase_date?->toDateString(),
            'vendor' => $this->vendor,
            'cost' => $this->cost,
            'warranty_expiry' => $this->warranty_expiry?->toDateString(),
            'status' => $this->status,
            'condition' => $this->condition,
            'room' => $this->whenLoaded('room', fn () => $this->room ? ['id' => $this->room->id, 'name' => $this->room->name] : null),
            'assigned_employee' => $this->whenLoaded('assignedEmployee', fn () => $this->assignedEmployee ? ['id' => $this->assignedEmployee->id, 'name' => $this->assignedEmployee->name, 'department' => $this->assignedEmployee->department?->name] : null),
            'notes' => $this->notes,
            'dynamic_fields' => $this->whenLoaded('fields', function () {
                return $this->fields->map(fn ($fv) => [
                    'id' => $fv->field->id,
                    'key' => $fv->field->key,
                    'name' => $fv->field->name,
                    'value' => $fv->value,
                ])->values();
            }),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
