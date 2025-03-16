<?php

declare(strict_types=1);

namespace App\Module\Auth\Handlers;

use App\Models\User;
use App\Module\Auth\Commands\ResetPasswordCommand;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

final class ResetPasswordHandler
{
    public function handle(ResetPasswordCommand $command): bool
    {
        $status = Password::reset(
            $command->DTO->toArray(),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET;
    }
}
