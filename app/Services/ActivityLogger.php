<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public function log(?User $user, string $event, ?Asset $asset = null, ?array $old = null, ?array $new = null): void
    {
        ActivityLog::create([
            'event' => $event,
            'user_id' => $user?->id,
            'asset_id' => $asset?->id,
            'old_values' => $old,
            'new_values' => $new,
            'ip_address' => Request::ip(),
        ]);
    }
}
