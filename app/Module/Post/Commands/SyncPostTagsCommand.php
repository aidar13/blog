<?php

declare(strict_types=1);

namespace App\Module\Post\Commands;

use App\Module\Post\Models\Post;

final class SyncPostTagsCommand
{
    public function __construct(public Post $post, public array $ids)
    {
    }
}
