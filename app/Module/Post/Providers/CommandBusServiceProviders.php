<?php

declare(strict_types=1);

namespace App\Module\Post\Providers;

use App\Module\Post\Commands\CreatePostCommand;
use App\Module\Post\Commands\RemovePostCommand;
use App\Module\Post\Commands\SyncPostCategoriesCommand;
use App\Module\Post\Commands\SyncPostTagsCommand;
use App\Module\Post\Commands\UpdatePostCommand;
use App\Module\Post\Commands\UpdatePostStatusCommand;
use App\Module\Post\Handlers\CreatePostHandler;
use App\Module\Post\Handlers\RemovePostHandler;
use App\Module\Post\Handlers\SyncPostCategoriesHandler;
use App\Module\Post\Handlers\SyncPostTagsHandler;
use App\Module\Post\Handlers\UpdatePostHandler;
use App\Module\Post\Handlers\UpdatePostStatusHandler;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

class CommandBusServiceProviders extends ServiceProvider
{
    private array $maps = [
        CreatePostCommand::class         => CreatePostHandler::class,
        UpdatePostCommand::class         => UpdatePostHandler::class,
        RemovePostCommand::class         => RemovePostHandler::class,
        UpdatePostStatusCommand::class   => UpdatePostStatusHandler::class,
        SyncPostTagsCommand::class       => SyncPostTagsHandler::class,
        SyncPostCategoriesCommand::class => SyncPostCategoriesHandler::class,
    ];

    public function boot(): void
    {
        $this->registerCommandHandlers();
    }

    private function registerCommandHandlers(): void
    {
        Bus::map($this->maps);
    }
}
