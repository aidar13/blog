<?php

namespace App\Module\Auth\Resources;

use App\Http\Resources\BaseJsonResource;
use App\Module\Auth\DTO\TokenDTO;

/**
 * @OA\Schema (
 *     @OA\Property(property="userId", type="integer", example="1"),
 *     @OA\Property(property="token", type="string", example="email@gmail.com"),
 * )
 *
 * @property TokenDTO $resource
 */
class LoginResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'userId' => $this->resource->userId,
            'token'  => $this->resource->token,
        ];
    }
}
