<?php

declare(strict_types=1);

namespace App\Module\Auth\Commands;

final class LogoutCommand
{
    public function __construct(
        public readonly int $userId
    ) {
    }
}
