<?php

declare(strict_types=1);

namespace App\Module\Auth\Handlers;

use App\Models\User;
use App\Module\Auth\Commands\RegisterCommand;
use App\Module\User\Contracts\Repositories\CreateUserRepository;
use Illuminate\Support\Facades\Hash;

final class RegisterHandler
{
    public function __construct(private readonly CreateUserRepository $repository)
    {
    }

    public function handle(RegisterCommand $command): void
    {
        $user           = new User();
        $user->email    = $command->DTO->email;
        $user->name     = $command->DTO->name;
        $user->password = Hash::make($command->DTO->password);

        $this->repository->create($user);
    }
}
