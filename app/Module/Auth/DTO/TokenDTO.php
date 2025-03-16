<?php

declare(strict_types=1);

namespace App\Module\Auth\DTO;

final class TokenDTO
{
    public int $userId;
    public string $token;

    public function __construct(
        int $userId,
        string $token
    ) {
        $this->userId = $userId;
        $this->token  = $token;
    }
}
