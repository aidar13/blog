<?php

declare(strict_types=1);

namespace App\Module\Auth\Handlers;

use App\Models\User;
use App\Module\Auth\Commands\LoginCommand;
use App\Module\Auth\DTO\TokenDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class LoginHandler
{
    /**
     * @throws ValidationException
     */
    public function handle(LoginCommand $command): TokenDTO
    {
        if (!Auth::attempt(['email' => $command->DTO->email, 'password' => $command->DTO->password])) {
            throw ValidationException::withMessages([
                'Invalid credentials'
            ]);
        }

        /** @var User $user */
        $user  = Auth::user();
        $token = $user->createToken('api')->plainTextToken;

        return new TokenDTO($user->id, $token);
    }
}
