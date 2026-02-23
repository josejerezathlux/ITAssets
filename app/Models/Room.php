<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = ['name', 'location', 'code'];

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }
<<<<<<< HEAD
=======

    public function mapShapes(): HasMany
    {
        return $this->hasMany(MapRoom::class, 'room_id');
    }
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
}
