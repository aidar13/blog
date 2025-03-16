<?php

declare(strict_types=1);

namespace App\Module\Auth\DTO;

use App\Module\Auth\Requests\LoginRequest;

final class LoginDTO
{
    public string $email;
    public string $password;

    public static function fromRequest(LoginRequest $request): self
    {
        $self           = new self();
        $self->email    = $request->get('email');
        $self->password = $request->get('password');

        return $self;
    }
}
