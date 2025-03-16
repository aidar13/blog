<?php

declare(strict_types=1);

namespace App\Module\Post\Handlers;

use App\Module\Post\Commands\UpdatePostCommand;
use App\Module\Post\Contracts\Queries\PostQuery;
use App\Module\Post\Contracts\Repositories\UpdatePostRepository;

final class UpdatePostHandler
{
    public function __construct(
        private readonly PostQuery $query,
        private readonly UpdatePostRepository $repository,
    ) {
    }

    public function handle(UpdatePostCommand $command): void
    {
        $model = $this->query->findById($command->DTO->id);

        $model->title          = $command->DTO->title;
        $model->content        = $command->DTO->content;
        $model->status         = $command->DTO->status;
        $model->featured_image = $command->DTO->featuredImage;
        $this->repository->update($model);
    }
}
