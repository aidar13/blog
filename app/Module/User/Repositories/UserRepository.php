<?php

declare(strict_types=1);

namespace App\Module\User\Repositories;

use App\Module\User\Contracts\Repositories\CreateUserRepository;
use App\Module\User\Contracts\Repositories\UpdateUserRepository;
use App\Models\User;
use Throwable;

final class UserRepository implements CreateUserRepository, UpdateUserRepository
{
    /**
     * @throws Throwable
     */
    public function create(User $user): void
    {
        $user->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function update(User $user): void
    {
        $user->updateOrFail();
    }
}
