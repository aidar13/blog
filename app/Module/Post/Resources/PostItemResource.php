<?php

declare(strict_types=1);

namespace App\Module\Post\Resources;

use App\Module\Post\Models\Post;
use App\Module\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="title"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         example="content"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="int",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="featuredImage",
 *         type="int",
 *         example="featuredImage"
 *     ),
 *     @OA\Property(
 *         property="createdAt",
 *         type="string",
 *         example="2025-01-01 00:01"
 *     ),
 *     @OA\Property(property="author", type="object", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="tags", description="tags", type="object", ref="#/components/schemas/TagResource"),
 *     @OA\Property(property="categories", description="categories", type="object", ref="#/components/schemas/CategoryResource")
 * )
 * @property-read Post $resource
 */
final class PostItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->resource->id,
            'title'         => $this->resource->title,
            'content'       => $this->resource->content,
            'status'        => $this->resource->status,
            'featuredImage' => $this->resource->featured_image,
            'createdAt'     => $this->resource->created_at->format('Y-m-d H:i:s'),
            'author'        => new UserResource($this->resource->author),
            'tags'          => TagResource::collection($this->resource->tags),
            'categories'    => CategoryResource::collection($this->resource->categories),
        ];
    }
}
