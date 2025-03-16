<?php

declare(strict_types=1);

namespace App\Module\Post\Contracts\Repositories;

use App\Module\Post\Models\Post;

interface CreatePostRepository
{
    public function create(Post $model): void;
}
