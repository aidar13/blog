<?php

declare(strict_types=1);

namespace App\Module\Auth\DTO;

use App\Module\Auth\Requests\ResetPasswordRequest;

final class ResetPasswordDTO
{
    public string $email;
    public string $token;
    public string $password;

    public static function fromRequest(ResetPasswordRequest $request): self
    {
        $self           = new self();
        $self->email    = $request->get('email');
        $self->token    = $request->get('token');
        $self->password = $request->get('password');

        return $self;
    }
}
