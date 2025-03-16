<?php

declare(strict_types=1);

namespace App\Module\Post\Queries\Eloquent;

use App\Module\Post\Contracts\Queries\PaginationPostQuery;
use App\Module\Post\Contracts\Queries\PostQuery as PostQueryContract;
use App\Module\Post\DTO\PostShowDTO;
use App\Module\Post\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PostQuery implements PostQueryContract, PaginationPostQuery
{
    public function findById(int $id): Post
    {
        /** @var Post */
        return Post::query()->findOrFail($id);
    }

    public function pagination(PostShowDTO $dto): LengthAwarePaginator
    {
        return Post::query()
            ->paginate($dto->limit, ['*'], 'page', $dto->page);
    }
}
