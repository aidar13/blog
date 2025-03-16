<?php

declare(strict_types=1);

namespace App\Module\Auth\Handlers;

use App\Module\Auth\Commands\LogoutCommand;
use App\Module\User\Contracts\Queries\UserQuery;

final class LogoutHandler
{
    public function __construct(private readonly UserQuery $query)
    {
    }

    public function handle(LogoutCommand $command): void
    {
        $user = $this->query->getById($command->userId);

        $user->tokens()?->delete();
    }
}
