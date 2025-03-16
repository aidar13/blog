<?php

declare(strict_types=1);

namespace App\Module\Auth\DTO;

use App\Module\Auth\Requests\ForgotPasswordRequest;

final class ForgotPasswordDTO
{
    public string $email;

    public static function fromRequest(ForgotPasswordRequest $request): self
    {
        $self        = new self();
        $self->email = $request->get('email');

        return $self;
    }
}
