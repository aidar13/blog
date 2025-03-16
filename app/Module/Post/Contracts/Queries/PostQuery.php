<?php

declare(strict_types=1);

namespace App\Module\Post\Contracts\Queries;

use App\Module\Post\Models\Post;

interface PostQuery
{
    public function findById(int $id): Post;
}
