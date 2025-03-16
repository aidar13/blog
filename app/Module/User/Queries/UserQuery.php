<?php

declare(strict_types=1);

namespace App\Module\User\Queries;

use App\Models\User;
use App\Module\User\Contracts\Queries\PaginationUserQuery;
use App\Module\User\Contracts\Queries\UserQuery as UserQueryContract;
use App\Module\User\DTO\UserShowDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

final class UserQuery implements UserQueryContract, PaginationUserQuery
{
    public function getById(int $id): User
    {
        /** @var User */
        return User::query()->where('id', $id)->firstOrFail();
    }

    public function getAllPaginated(UserShowDTO $DTO): LengthAwarePaginator
    {
        return User::query()
            ->where('id', '!=', $DTO->currentUserId)
            ->when($DTO->name, function (Builder $query) use ($DTO) {
                return $query->where('name', 'like' , '%' . $DTO->name . '%');
            })
            ->paginate($DTO->limit, ['*'], 'page', $DTO->page);
    }
}
