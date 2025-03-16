<?php

declare(strict_types=1);

namespace App\Module\Post\Commands;

final class UpdatePostStatusCommand
{
    public function __construct(public int $id, public int $status)
    {
    }
}
