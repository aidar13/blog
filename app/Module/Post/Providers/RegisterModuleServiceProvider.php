<?php

declare(strict_types=1);

namespace App\Module\Post\Providers;

use Illuminate\Support\ServiceProvider;

class RegisterModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(BindServiceProvider::class);
        $this->app->register(CommandBusServiceProviders::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    public function boot()
    {
        //
    }
}
