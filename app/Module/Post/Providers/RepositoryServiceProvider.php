<?php

declare(strict_types=1);

namespace App\Module\Post\Providers;

use App\Module\Post\Contracts\Queries\PaginationPostQuery;
use App\Module\Post\Contracts\Queries\PostQuery as PostQueryContract;
use App\Module\Post\Contracts\Repositories\CreatePostRepository;
use App\Module\Post\Contracts\Repositories\RemovePostRepository;
use App\Module\Post\Contracts\Repositories\UpdatePostRepository;
use App\Module\Post\Queries\Eloquent\PostQuery;
use App\Module\Post\Repositories\Eloquent\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        PostQueryContract::class => PostQuery::class,
        PaginationPostQuery::class => PostQuery::class,
        CreatePostRepository::class => PostRepository::class,
        UpdatePostRepository::class => PostRepository::class,
        RemovePostRepository::class => PostRepository::class,
    ];
}
