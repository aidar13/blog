<?php

declare(strict_types=1);

namespace App\Module\Auth\Providers;

use App\Module\Auth\Commands\LoginCommand;
use App\Module\Auth\Commands\LogoutCommand;
use App\Module\Auth\Commands\RegisterCommand;
use App\Module\Auth\Handlers\LoginHandler;
use App\Module\Auth\Handlers\LogoutHandler;
use App\Module\Auth\Handlers\RegisterHandler;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

final class CommandBusServiceProviders extends ServiceProvider
{
    public function boot(): void
    {
        Bus::map([
            LoginCommand::class    => LoginHandler::class,
            RegisterCommand::class => RegisterHandler::class,
            LogoutCommand::class   => LogoutHandler::class,
        ]);
    }
}
