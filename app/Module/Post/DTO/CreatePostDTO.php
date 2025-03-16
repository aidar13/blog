<?php

declare(strict_types=1);

namespace App\Module\Post\DTO;

use App\Module\Post\Requests\CreatePostRequest;
use App\Traits\ToArrayTrait;

final class CreatePostDTO
{
    use ToArrayTrait;

    public int $authorId;
    public string $title;
    public string $content;
    public int $status;
    public ?string $featuredImage;
    public array $categoryIds;
    public array $tagIds;

    public static function fromRequest(CreatePostRequest $request): self
    {
        $self                = new self();
        $self->authorId      = (int)$request->get('authorId');
        $self->title         = $request->get('title');
        $self->content       = $request->get('content');
        $self->status        = (int)$request->get('status');
        $self->featuredImage = $request->get('featuredImage');
        $self->categoryIds   = $request->get('categoryIds');
        $self->tagIds        = $request->get('tagIds');

        return $self;
    }
}
