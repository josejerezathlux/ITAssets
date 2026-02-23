<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = ['event', 'user_id', 'asset_id', 'old_values', 'new_values', 'ip_address'];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    protected $appends = ['event_label'];

    public function getEventLabelAttribute(): string
    {
        return self::eventLabel($this->event);
    }

    public static function eventLabel(string $event): string
    {
        $labels = [
            'asset.created' => 'Asset created',
            'asset.updated' => 'Asset updated',
            'assignment.checked_out' => 'Checked out',
            'assignment.checked_in' => 'Checked in',
            'attachment.uploaded' => 'Attachment uploaded',
            'attachment.deleted' => 'Attachment removed',
            'maintenance.added' => 'Maintenance log added',
        ];

        return $labels[$event] ?? ucfirst(str_replace('.', ' – ', $event));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
