<?php

declare(strict_types=1);

namespace App\Module\Auth\Commands;

use App\Module\Auth\DTO\ResetPasswordDTO;

final class ResetPasswordCommand
{
    public function __construct(public readonly ResetPasswordDTO $DTO)
    {
    }
}
