<?php

declare(strict_types=1);

namespace App\Module\User\Contracts\Queries;

use App\Module\User\DTO\UserShowDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PaginationUserQuery
{
    public function getAllPaginated(UserShowDTO $DTO): LengthAwarePaginator;
}
