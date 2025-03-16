<?php

declare(strict_types=1);

namespace App\Module\User\Resources;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

/**
 * Class UsersResource.
 *
 * @package namespace App\Module\User\Resources;
 */
final class UsersResource extends BaseResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => UserResource::collection($this->collection)
        ];
    }
}
