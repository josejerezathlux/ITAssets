<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MapPlacement extends Model
{
    protected $fillable = ['asset_id', 'x', 'y'];

    protected $casts = [
        'x' => 'integer',
        'y' => 'integer',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
