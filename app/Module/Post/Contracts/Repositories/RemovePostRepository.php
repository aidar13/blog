<?php

declare(strict_types=1);

namespace App\Module\Post\Contracts\Repositories;

use App\Module\Post\Models\Post;

interface RemovePostRepository
{
    public function remove(Post $model): void;
}
