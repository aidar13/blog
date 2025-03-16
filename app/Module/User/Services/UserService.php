<?php

declare(strict_types=1);

namespace App\Module\User\Services;

use App\Module\User\Contracts\Queries\PaginationUserQuery;
use App\Module\User\Contracts\Queries\UserQuery;
use App\Module\User\Contracts\Services\UserService as UserServiceContract;
use App\Module\User\DTO\UserShowDTO;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

final class UserService implements UserServiceContract
{
    public function __construct(
        private readonly UserQuery $query,
        private readonly PaginationUserQuery $paginationUserQuery,
    ) {
    }

    public function getById(int $id): User
    {
        return $this->query->getById($id);
    }

    public function getAllPaginated(UserShowDTO $DTO): LengthAwarePaginator
    {
        $DTO->setCurrentUserId((int)Auth::id());

        return $this->paginationUserQuery->getAllPaginated($DTO);
    }
}
