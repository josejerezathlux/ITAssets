<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetField extends Model
{
    protected $fillable = [
        'asset_category_id', 'name', 'key', 'input_type',
        'options', 'is_required', 'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(AssetFieldValue::class, 'asset_field_id');
    }
}
