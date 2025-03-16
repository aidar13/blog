<?php

declare(strict_types=1);

namespace App\Module\Auth\DTO;

use App\Module\Auth\Requests\ResetPasswordRequest;
use App\Traits\ToArrayTrait;

final class ResetPasswordDTO
{
    use ToArrayTrait;

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
