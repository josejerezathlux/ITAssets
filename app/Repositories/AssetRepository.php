<?php

namespace App\Repositories;

use App\Models\Asset;
use App\Repositories\Contracts\AssetRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AssetRepository implements AssetRepositoryInterface
{
    public function paginateWithFilters(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        $query = Asset::with(['category', 'room', 'assignedEmployee']);

        if (! empty($filters['category_id'] ?? null)) {
            $query->where('asset_category_id', $filters['category_id']);
        }
        if (! empty($filters['status'] ?? null)) {
            $query->where('status', $filters['status']);
        }
        if (! empty($filters['room_id'] ?? null)) {
            $query->where('room_id', $filters['room_id']);
        }
        if (isset($filters['assigned']) && $filters['assigned'] !== '' && $filters['assigned'] !== null) {
            if ($filters['assigned']) {
                $query->whereNotNull('assigned_employee_id');
            } else {
                $query->whereNull('assigned_employee_id');
            }
        }
        if (! empty($filters['search'] ?? null)) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('asset_tag', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('make', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        return $query->orderByDesc('updated_at')->paginate($perPage);
    }

    public function find(int $id): ?Asset
    {
        return Asset::with([
            'category.fields',
            'fields.field',
            'room',
            'assignedEmployee',
            'attachments',
            'maintenanceLogs.performedBy',
            'activityLogs.user',
            'assignments.employee',
        ])->find($id);
    }

    public function create(array $data): Asset
    {
        return Asset::create($data);
    }

    public function update(Asset $asset, array $data): Asset
    {
        $asset->update($data);
        return $asset->fresh();
    }

    public function delete(Asset $asset): void
    {
        $asset->delete();
    }
}
