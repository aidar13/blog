<?php

declare(strict_types=1);

namespace App\Module\User\Resources;

use App\Http\Resources\BaseJsonResource;
use App\Models\User;

/**
 * @OA\Schema (
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="email", type="string", example="email@gmail.com"),
 *     @OA\Property(property="name", type="string", example="name"),
 * )
 *
 * @property User $resource
 */
final class ProfileResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->resource->id,
            'email' => $this->resource->email,
            'name'  => $this->resource->name,
        ];
    }
}
