<?php

declare(strict_types=1);

namespace App\Module\Post\Contracts\Services;

use App\Module\Post\DTO\PostShowDTO;
use App\Module\Post\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostService
{
    public function getAllPost(PostShowDTO $dto): LengthAwarePaginator;

    public function getPostById(int $id): Post;
}
