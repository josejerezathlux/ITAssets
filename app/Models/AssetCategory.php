<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetCategory extends Model
{
    protected $fillable = ['name', 'slug', 'icon'];

    public static function defaultIconKey(): string
    {
        return 'box';
    }

    public function getMapIconKey(): string
    {
        if ($this->icon) {
            return $this->icon;
        }
        return config('map_icons.category_slug_to_icon')[$this->slug ?? ''] ?? self::defaultIconKey();
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(AssetField::class)->orderBy('sort_order');
    }
}
