<?php

declare(strict_types=1);

namespace App\Module\Post\Contracts\Queries;

use App\Module\Post\DTO\PostShowDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PaginationPostQuery
{
    public function pagination(PostShowDTO $dto): LengthAwarePaginator;
}
