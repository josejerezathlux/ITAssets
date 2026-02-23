<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = ['name', 'label', 'permissions'];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission(string $permission): bool
    {
        $permissions = $this->permissions ?? [];
        if (in_array('*', $permissions, true)) {
            return true;
        }
        return in_array($permission, $permissions, true);
    }

    public static function permissionKeys(): array
    {
        $keys = [];
        foreach (config('permissions.modules', []) as $module => $config) {
            foreach ($config['actions'] ?? [] as $action) {
                $keys[] = "{$module}.{$action}";
            }
        }
        return $keys;
    }
}
