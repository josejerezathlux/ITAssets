<?php

namespace App\Policies;

use App\Models\DigitalAsset;
use App\Models\User;

class DigitalAssetPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('digital_assets.view');
    }

    public function view(User $user, DigitalAsset $digitalAsset): bool
    {
        return $user->hasPermission('digital_assets.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('digital_assets.create');
    }

    public function update(User $user, DigitalAsset $digitalAsset): bool
    {
        return $user->hasPermission('digital_assets.update');
    }

    public function delete(User $user, DigitalAsset $digitalAsset): bool
    {
        return $user->hasPermission('digital_assets.delete');
    }

    public function assign(User $user, DigitalAsset $digitalAsset): bool
    {
        return $user->hasPermission('digital_assets.assign');
    }
}
