<?php

declare(strict_types=1);

namespace App\Module\Post\Handlers;

use App\Module\Post\Commands\RemovePostCommand;
use App\Module\Post\Contracts\Queries\PostQuery;
use App\Module\Post\Contracts\Repositories\RemovePostRepository;

final class RemovePostHandler
{
    public function __construct(
        private readonly PostQuery $query,
        private readonly RemovePostRepository $repository
    ) {
    }

    public function handle(RemovePostCommand $command): void
    {
        $post = $this->query->findById($command->id);

        $this->repository->remove($post);
    }
}
