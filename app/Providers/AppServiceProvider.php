<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\AssetRepositoryInterface::class,
            \App\Repositories\AssetRepository::class
        );
    }

    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.fluent');
    }
}
