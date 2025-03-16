<?php

declare(strict_types=1);

namespace App\Module\Post\Services;

use App\Module\Post\Contracts\Queries\PaginationPostQuery;
use App\Module\Post\Contracts\Queries\PostQuery;
use App\Module\Post\Contracts\Services\PostService as PostServiceContract;
use App\Module\Post\DTO\PostShowDTO;
use App\Module\Post\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PostService implements PostServiceContract
{
    public function __construct(
        private readonly PaginationPostQuery $paginationPostQuery,
        private readonly PostQuery $query
    ) {
    }

    public function getAllPost(PostShowDTO $dto): LengthAwarePaginator
    {
        return $this->paginationPostQuery->pagination($dto);
    }

    public function getPostById(int|string $id): Post
    {
        return $this->query->findById($id);
    }
}
