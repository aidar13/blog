<?php

declare(strict_types=1);

namespace App\Module\Post\DTO;

use App\Module\Post\Requests\PostShowRequest;
use App\Traits\ToArrayTrait;

final class PostShowDTO
{
    use ToArrayTrait;

    public int $limit;
    public int $page;


    public static function fromRequest(PostShowRequest $request): self
    {
        $self        = new self();
        $self->limit = (int)$request->get('limit', 20);
        $self->page  = (int)$request->get('page', 1);

        return $self;
    }
}
