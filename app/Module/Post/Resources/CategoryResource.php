<?php

declare(strict_types=1);

namespace App\Module\Post\Resources;

use App\Module\Post\Models\Category;
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
 * @property Category $resource
 */
final class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'   => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
