<?php

declare(strict_types=1);

namespace App\Module\User\DTO;

use App\Module\User\Requests\UserShowRequest;

final class UserShowDTO
{
    public int $limit;
    public int $page;
    public ?string $name;
    public ?int $currentUserId;

    public static function fromRequest(UserShowRequest $request): UserShowDTO
    {
        $self        = new self();
        $self->limit = (int)$request->get('limit', 20);
        $self->page  = (int)$request->get('page', 1);
        $self->name  = $request->get('name');
        $self->name  = $request->get('name');

        return $self;
    }

    public function setCurrentUserId(int $userId): void
    {
        $this->currentUserId = $userId;
    }
}
