<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\MaintenanceLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MaintenanceLogsSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()?->id;
        $assetIds = Asset::pluck('id')->all();
        if (empty($assetIds) || !$userId) {
            return;
        }

        $types = ['repair', 'upgrade', 'inspection'];
        $notesRepair = ['Replaced faulty power supply.', 'Cleaned fans and reapplied thermal paste.', 'Display cable replaced.', 'RAM reseated.', 'HDD replaced with SSD.'];
        $notesUpgrade = ['RAM upgraded to 32 GB.', 'OS upgrade to Windows 11.', 'SSD upgrade to 1 TB.'];
        $notesInspection = ['Annual hardware check – passed.', 'Firmware update applied.', 'No issues found.'];

        $created = 0;
        $target = min(35, count($assetIds) * 2);
        $maxAttempts = $target * 10;
        $attempts = 0;
        while ($created < $target && $attempts++ < $maxAttempts) {
            $assetId = $assetIds[array_rand($assetIds)];
            $type = $types[array_rand($types)];
            $date = Carbon::now()->subDays(rand(5, 365));
            $notes = match ($type) {
                'repair' => $notesRepair[array_rand($notesRepair)],
                'upgrade' => $notesUpgrade[array_rand($notesUpgrade)],
                'inspection' => $notesInspection[array_rand($notesInspection)],
                default => null,
            };

            $log = MaintenanceLog::firstOrCreate(
                [
                    'asset_id' => $assetId,
                    'date' => $date,
                    'type' => $type,
                ],
                [
                    'performed_by' => $userId,
                    'notes' => $notes,
                ]
            );
            if ($log->wasRecentlyCreated) {
                $created++;
            }
        }
    }
}
