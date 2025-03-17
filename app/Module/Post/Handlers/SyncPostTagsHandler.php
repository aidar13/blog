<?php

declare(strict_types=1);

namespace App\Module\Post\Handlers;

use App\Module\Post\Commands\SyncPostTagsCommand;

final class SyncPostTagsHandler
{
    public function handle(SyncPostTagsCommand $command): void
    {
        $command->post->tags()->sync($command->ids);
    }
}
