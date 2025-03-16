<?php

declare(strict_types=1);

namespace App\Module\Post\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class PostsResource.
 *
 * @package namespace App\Module\Post\Resources;
 */
final class PostsResource extends ResourceCollection
{

   public function toArray($request): array
   {
        return [
            'data' => PostResource::collection($this->collection),
        ];
   }
}
