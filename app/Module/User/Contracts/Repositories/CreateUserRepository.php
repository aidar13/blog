<?php

declare(strict_types=1);

namespace App\Module\User\Contracts\Repositories;

use App\Models\User;

interface CreateUserRepository
{
    public function create(User $user): void;
}
