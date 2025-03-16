<?php

declare(strict_types=1);

namespace App\Module\Post\Commands;

use App\Module\Post\DTO\CreatePostDTO;

final class CreatePostCommand
{
    public function __construct(public CreatePostDTO $DTO)
    {
    }
}
