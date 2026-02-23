<?php

namespace App\Providers;

use App\Models\Asset;
use App\Models\AssetCategory;
<<<<<<< HEAD
use App\Models\Employee;
use App\Models\Room;
use App\Policies\AssetCategoryPolicy;
use App\Policies\AssetPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\RoomPolicy;
=======
use App\Models\Department;
use App\Models\DigitalAsset;
use App\Models\Employee;
use App\Models\Room;
use App\Models\User;
use App\Policies\AssetCategoryPolicy;
use App\Policies\AssetPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\DigitalAssetPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\RolePolicy;
use App\Policies\RoomPolicy;
use App\Policies\UserPolicy;
use App\Models\Role;
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Asset::class => AssetPolicy::class,
        AssetCategory::class => AssetCategoryPolicy::class,
<<<<<<< HEAD
        Employee::class => EmployeePolicy::class,
        Room::class => RoomPolicy::class,
=======
        Department::class => DepartmentPolicy::class,
        DigitalAsset::class => DigitalAssetPolicy::class,
        Employee::class => EmployeePolicy::class,
        Role::class => RolePolicy::class,
        Room::class => RoomPolicy::class,
        User::class => UserPolicy::class,
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
