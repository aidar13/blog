<?php

declare(strict_types=1);

namespace App\Module\Post\Commands;

use App\Module\Post\DTO\UpdatePostDTO;

final class UpdatePostCommand
{
    public function __construct(public UpdatePostDTO $DTO)
    {
    }
}
