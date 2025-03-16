<?php

declare(strict_types=1);

namespace App\Module\Post\Handlers;

use App\Module\Post\Commands\CreatePostCommand;
use App\Module\Post\Contracts\Repositories\CreatePostRepository;
use App\Module\Post\Models\Post;

final class CreatePostHandler
{
    public function __construct(private readonly CreatePostRepository $repository)
    {
    }

    public function handle(CreatePostCommand $command): void
    {
        $model                 = new Post();
        $model->author_id      = $command->DTO->authorId;
        $model->title          = $command->DTO->title;
        $model->content        = $command->DTO->content;
        $model->status         = $command->DTO->status;
        $model->featured_image = $command->DTO->featuredImage;
        $this->repository->create($model);
    }
}
