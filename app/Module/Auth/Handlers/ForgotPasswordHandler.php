<?php

declare(strict_types=1);

namespace App\Module\Auth\Handlers;

use App\Module\Auth\Commands\ForgotPasswordCommand;
use App\Module\User\Contracts\Queries\UserQuery;
use Illuminate\Support\Facades\Password;

final class ForgotPasswordHandler
{
    public function __construct(private readonly UserQuery $query)
    {
    }

    public function handle(ForgotPasswordCommand $command): bool
    {
        $user = $this->query->getByEmail($command->DTO->email);

        $status = Password::sendResetLink(['email' => $user->email]);

        return $status === Password::RESET_LINK_SENT;
    }
}
