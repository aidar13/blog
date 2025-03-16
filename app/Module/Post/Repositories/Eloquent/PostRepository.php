<?php

declare(strict_types=1);

namespace App\Module\Post\Repositories\Eloquent;

use App\Module\Post\Contracts\Repositories\CreatePostRepository;
use App\Module\Post\Contracts\Repositories\RemovePostRepository;
use App\Module\Post\Contracts\Repositories\UpdatePostRepository;
use App\Module\Post\Models\Post;
use Throwable;

final class PostRepository implements CreatePostRepository, UpdatePostRepository, RemovePostRepository
{
    /**
     * @throws Throwable
     */
    public function create(Post $model): void
    {
        $model->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function update(Post $model): void
    {
        $model->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function remove(Post $model): void
    {
        $model->deleteOrFail();
    }
}
