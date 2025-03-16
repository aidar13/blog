<?php

declare(strict_types=1);

namespace App\Module\User\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

final class CommandBusServiceProviders extends ServiceProvider
{
    public function boot(): void
    {
        Bus::map([
        ]);
    }
}
