<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Module\Post\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'author_id'      => User::factory()->create(),
            'status'         => $this->faker->randomElement([
                Post::STATUS_DRAFT,
                Post::STATUS_PUBLISHED
            ]),
            'title'          => $this->faker->title,
            'content'        => $this->faker->text,
            'featured_image' => $this->faker->imageUrl,
        ];
    }
}
