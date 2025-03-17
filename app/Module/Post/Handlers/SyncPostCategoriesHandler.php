<?php

declare(strict_types=1);

namespace App\Module\Post\Handlers;

use App\Module\Post\Commands\SyncPostCategoriesCommand;

final class SyncPostCategoriesHandler
{
    public function handle(SyncPostCategoriesCommand $command): void
    {
        $command->post->categories()->sync($command->ids);
    }
}
