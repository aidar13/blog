<?php

declare(strict_types=1);

namespace App\Module\Post\Providers;

use App\Module\Post\Contracts\Services\PostService as PostServiceContract;
use App\Module\Post\Services\PostService;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public array $bindings = [
        PostServiceContract::class => PostService::class,
    ];
}
