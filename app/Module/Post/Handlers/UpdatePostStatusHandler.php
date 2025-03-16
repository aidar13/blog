<?php

declare(strict_types=1);

namespace App\Module\Post\Handlers;

use App\Module\Post\Commands\UpdatePostStatusCommand;
use App\Module\Post\Contracts\Queries\PostQuery;
use App\Module\Post\Contracts\Repositories\UpdatePostRepository;

final class UpdatePostStatusHandler
{
    public function __construct(
        private readonly PostQuery $query,
        private readonly UpdatePostRepository $repository,
    ) {
    }

    public function handle(UpdatePostStatusCommand $command): void
    {
        $model = $this->query->findById($command->id);

        $model->status = $command->status;

        $this->repository->update($model);
    }
}
