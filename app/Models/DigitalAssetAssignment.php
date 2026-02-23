<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DigitalAssetAssignment extends Model
{
    protected $fillable = ['digital_asset_id', 'assignable_type', 'assignable_id', 'assigned_at', 'notes'];

    protected $casts = [
        'assigned_at' => 'date',
    ];

    public function digitalAsset(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DigitalAsset::class);
    }

    public function assignable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getAssignableNameAttribute(): string
    {
        $a = $this->assignable;
        return $a ? $a->name : '—';
    }
}
