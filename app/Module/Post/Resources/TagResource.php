<?php

declare(strict_types=1);

namespace App\Module\Post\Resources;

use App\Module\Post\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     @OA\Property(
 *         property="id",
 *         type="int",
 *         description="id"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="name"
 *     ),
 * )
 * @property Tag $resource
 */
final class TagResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'   => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
