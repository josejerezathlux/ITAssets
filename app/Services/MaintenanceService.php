<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\MaintenanceLog;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MaintenanceService
{
    public function __construct(
        protected ActivityLogger $logger,
    ) {}

    public function create(Asset $asset, array $data, ?User $user = null, ?UploadedFile $file = null): MaintenanceLog
    {
        $path = null;
        if ($file) {
            $path = $file->store('maintenance', 'public');
        }

        $log = MaintenanceLog::create([
            'asset_id' => $asset->id,
            'date' => $data['date'],
            'performed_by' => $user?->id ?? $data['performed_by'] ?? null,
            'type' => $data['type'],
            'notes' => $data['notes'] ?? null,
            'attachment_path' => $path,
        ]);

        $this->logger->log($user, 'maintenance.added', $asset, null, $log->toArray());

        return $log;
    }
}
