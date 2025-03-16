<?php

declare(strict_types=1);

namespace App\Module\Auth\DTO;

use App\Module\Auth\Requests\ResetPasswordRequest;

final class ResetPasswordDTO
{
    public string $email;

    public static function fromRequest(ResetPasswordRequest $request): self
    {
        $self        = new self();
        $self->email = $request->get('email');

        return $self;
    }
}
