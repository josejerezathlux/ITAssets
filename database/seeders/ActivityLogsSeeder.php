<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Asset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivityLogsSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()?->id;
        $assetIds = Asset::pluck('id')->all();
        if (empty($assetIds) || !$userId) {
            return;
        }

        $events = [
            'asset.created' => 25,
            'asset.updated' => 40,
            'assignment.checked_out' => 30,
            'assignment.checked_in' => 20,
            'maintenance.added' => 15,
        ];

        foreach ($events as $event => $count) {
            for ($i = 0; $i < $count; $i++) {
                $assetId = $assetIds[array_rand($assetIds)];
                $createdAt = Carbon::now()->subDays(rand(1, 180))->subHours(rand(0, 23));
                ActivityLog::create([
                    'event' => $event,
                    'user_id' => $userId,
                    'asset_id' => $assetId,
                    'old_values' => in_array($event, ['asset.updated', 'assignment.checked_in']) ? ['status' => 'previous'] : null,
                    'new_values' => ['status' => 'current'],
                    'ip_address' => '192.168.1.' . rand(1, 254),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }
        }
    }
}
