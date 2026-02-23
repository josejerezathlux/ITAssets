<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\AssetFieldValue;
use App\Models\Employee;
use App\Models\User;
use App\Repositories\Contracts\AssetRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AssetService
{
    public function __construct(
        protected AssetRepositoryInterface $assets,
        protected ActivityLogger $logger,
    ) {}

    public function createAsset(array $data, array $dynamicFields, User $user): Asset
    {
        return DB::transaction(function () use ($data, $dynamicFields, $user) {
            $asset = $this->assets->create($data);
            $this->saveDynamicFields($asset, $dynamicFields);
            $this->logger->log($user, 'asset.created', $asset, null, $asset->toArray());
            return $asset;
        });
    }

    public function updateAsset(Asset $asset, array $data, array $dynamicFields, User $user): Asset
    {
        return DB::transaction(function () use ($asset, $data, $dynamicFields, $user) {
            $old = $asset->toArray();
            $this->assets->update($asset, $data);
            $asset->refresh();
            $this->saveDynamicFields($asset, $dynamicFields);
            $this->logger->log($user, 'asset.updated', $asset, $old, $asset->toArray());
            return $asset->fresh();
        });
    }

    protected function saveDynamicFields(Asset $asset, array $fields): void
    {
        foreach ($fields as $fieldId => $value) {
            if ($value === null || $value === '') {
                AssetFieldValue::where('asset_id', $asset->id)
                    ->where('asset_field_id', $fieldId)
                    ->delete();
                continue;
            }
            AssetFieldValue::updateOrCreate(
                ['asset_id' => $asset->id, 'asset_field_id' => $fieldId],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }
    }

    public function checkOut(Asset $asset, Employee $employee, User $user, ?string $notes = null): void
    {
        DB::transaction(function () use ($asset, $employee, $user, $notes) {
            $asset->update([
                'status' => 'in_use',
                'assigned_employee_id' => $employee->id,
            ]);
            $assignment = $asset->assignments()->create([
                'employee_id' => $employee->id,
                'checked_out_at' => now(),
                'status' => 'checked_out',
                'performed_by' => $user->id,
                'notes' => $notes,
            ]);
            $this->logger->log($user, 'assignment.checked_out', $asset, null, $assignment->toArray());
        });
    }

    public function checkIn(Asset $asset, User $user, ?string $notes = null): void
    {
        DB::transaction(function () use ($asset, $user, $notes) {
            $assignment = $asset->assignments()
                ->whereNull('checked_in_at')
                ->latest('checked_out_at')
                ->first();

            if ($assignment) {
                $assignment->update([
                    'checked_in_at' => now(),
                    'status' => 'checked_in',
                    'notes' => $notes,
                ]);
            }

            $asset->update([
                'status' => 'in_stock',
                'assigned_employee_id' => null,
            ]);

            $this->logger->log($user, 'assignment.checked_in', $asset);
        });
    }
}
