<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DigitalAsset extends Model
{
    protected $fillable = [
        'name', 'type', 'vendor', 'product_name', 'sku', 'description',
        'license_key_reference', 'status', 'start_date', 'end_date', 'renewal_date',
        'next_billing_date', 'billing_cycle', 'cost', 'currency', 'quantity',
        'auto_renew', 'terms_url', 'portal_url', 'category', 'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'renewal_date' => 'date',
        'next_billing_date' => 'date',
        'cost' => 'decimal:2',
        'auto_renew' => 'boolean',
    ];

    public function assignments(): HasMany
    {
        return $this->hasMany(DigitalAssetAssignment::class);
    }

    public function getAssignedCountAttribute(): int
    {
        return $this->assignments()->count();
    }

    public function getAvailableSeatsAttribute(): int
    {
        return max(0, $this->quantity - $this->assignments()->count());
    }

    public static function typeOptions(): array
    {
        return [
            'license' => 'License',
            'subscription' => 'Subscription',
            'saas' => 'SaaS',
            'maintenance' => 'Maintenance',
            'support_contract' => 'Support contract',
            'other' => 'Other',
        ];
    }

    public static function statusOptions(): array
    {
        return [
            'active' => 'Active',
            'trial' => 'Trial',
            'pending_renewal' => 'Pending renewal',
            'expired' => 'Expired',
            'cancelled' => 'Cancelled',
            'suspended' => 'Suspended',
        ];
    }

    public static function billingCycleOptions(): array
    {
        return [
            'one_time' => 'One-time',
            'monthly' => 'Monthly',
            'quarterly' => 'Quarterly',
            'annually' => 'Annually',
            'biennially' => 'Every 2 years',
            'custom' => 'Custom',
        ];
    }
}
