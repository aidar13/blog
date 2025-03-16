<?php

declare(strict_types=1);

namespace App\Module\Auth\Commands;

use App\Module\Auth\DTO\ForgotPasswordDTO;

final class ForgotPasswordCommand
{
    public function __construct(public readonly ForgotPasswordDTO $DTO)
    {
    }
}
