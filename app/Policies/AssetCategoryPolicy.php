<?php

namespace App\Policies;

use App\Models\AssetCategory;
use App\Models\User;

class AssetCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('categories.view');
    }

    public function view(User $user, AssetCategory $assetCategory): bool
    {
        return $user->hasPermission('categories.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('categories.create');
    }

    public function update(User $user, AssetCategory $assetCategory): bool
    {
        return $user->hasPermission('categories.update');
    }

    public function delete(User $user, AssetCategory $assetCategory): bool
    {
        return $user->hasPermission('categories.delete');
    }
}
