<?php

declare(strict_types=1);

namespace App\Module\User\Resources;

use App\Http\Resources\BaseJsonResource;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Name"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         example="email"
 *     ),
 * )
 * @property-read User $resource
 */
final class UserResource extends BaseJsonResource
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
            'id'    => $this->resource->id,
            'name'  => $this->resource->name,
            'email' => $this->resource->email,
        ];
    }
}
