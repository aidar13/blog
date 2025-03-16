<?php

declare(strict_types=1);

namespace App\Module\User\Contracts\Services;

use App\Module\User\DTO\UserShowDTO;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserService
{
    public function getById(int $id): User;

    public function getAllPaginated(UserShowDTO $DTO): LengthAwarePaginator;
}
