<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

class RoomPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('rooms.view');
    }

    public function view(User $user, Room $room): bool
    {
        return $user->hasPermission('rooms.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('rooms.create');
    }

    public function update(User $user, Room $room): bool
    {
        return $user->hasPermission('rooms.update');
    }

    public function delete(User $user, Room $room): bool
    {
        return $user->hasPermission('rooms.delete');
    }
}
