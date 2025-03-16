<?php

declare(strict_types=1);

namespace App\Module\Auth\Commands;

use App\Module\Auth\DTO\LoginDTO;

final class LoginCommand
{
    public function __construct(public readonly LoginDTO $DTO)
    {
    }
}
