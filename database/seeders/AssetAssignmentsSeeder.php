<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AssetAssignmentsSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()?->id;
        if (!$userId) {
            return;
        }

        // Current assignments for assets that are in_use and have assigned_employee_id
        foreach (Asset::where('status', 'in_use')->whereNotNull('assigned_employee_id')->get() as $asset) {
            AssetAssignment::firstOrCreate(
                [
                    'asset_id' => $asset->id,
                    'employee_id' => $asset->assigned_employee_id,
                    'status' => 'checked_out',
                ],
                [
                    'checked_out_at' => Carbon::now()->subDays(rand(5, 120)),
                    'checked_in_at' => null,
                    'performed_by' => $userId,
                    'notes' => null,
                ]
            );
        }

        // Some historical (checked-in) assignments for variety
        $employees = \App\Models\Employee::pluck('id')->all();
        if (empty($employees)) {
            return;
        }
        $assetIds = Asset::whereIn('status', ['in_use', 'in_stock'])->pluck('id')->all();
        $toAdd = min(15, (int) (count($assetIds) * 0.3));
        $added = 0;
        shuffle($assetIds);
        foreach ($assetIds as $assetId) {
            if ($added >= $toAdd) {
                break;
            }
            $existingCount = AssetAssignment::where('asset_id', $assetId)->where('status', 'checked_in')->count();
            if ($existingCount >= 2) {
                continue;
            }
            AssetAssignment::create([
                'asset_id' => $assetId,
                'employee_id' => $employees[array_rand($employees)],
                'checked_out_at' => Carbon::now()->subDays(rand(90, 400)),
                'checked_in_at' => Carbon::now()->subDays(rand(30, 80)),
                'status' => 'checked_in',
                'performed_by' => $userId,
                'notes' => null,
            ]);
            $added++;
        }
    }
}
