<?php

declare(strict_types=1);

namespace App\Module\Auth\Commands;

use App\Module\Auth\DTO\RegisterDTO;

final class RegisterCommand
{
    public function __construct(public readonly RegisterDTO $DTO)
    {
    }
}
