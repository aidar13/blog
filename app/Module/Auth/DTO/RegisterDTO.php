<?php

declare(strict_types=1);

namespace App\Module\Auth\DTO;

use App\Module\Auth\Requests\RegisterRequest;

final class RegisterDTO
{
    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(RegisterRequest $request): self
    {
        $self           = new self();
        $self->name     = $request->get('name');
        $self->email    = $request->get('email');
        $self->password = $request->get('password');

        return $self;
    }
}
