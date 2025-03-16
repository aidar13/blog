<?php

declare(strict_types=1);

namespace App\Module\User\Providers;

use App\Module\User\Contracts\Services\UserService as UserServiceContract;
use App\Module\User\Services\UserService;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public array $bindings = [
        // Services
        UserServiceContract::class => UserService::class,
    ];

    public function register(): void
    {
    }
}
