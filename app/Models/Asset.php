<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'asset_tag', 'asset_category_id', 'serial_number',
        'make', 'model', 'purchase_date', 'vendor', 'cost',
        'warranty_expiry', 'status', 'condition', 'room_id',
        'assigned_employee_id', 'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
        'cost' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function assignedEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_employee_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(AssetFieldValue::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }

    public function maintenanceLogs(): HasMany
    {
        return $this->hasMany(MaintenanceLog::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }
<<<<<<< HEAD
=======

    public function mapPlacement(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MapPlacement::class);
    }
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
}
