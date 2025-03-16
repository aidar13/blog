<?php

namespace Tests\Feature;

use App\Models\User;
use App\Module\Post\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
    }

    public function testGetAllPosts()
    {
        Post::factory()->count(20)->create();

        $response = $this->get(route('posts.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data'  => [
                    [
                        'id',
                        'title',
                        'status',
                        'createdAt',
                        'author' => ['id', 'name'],
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta'  => [
                    'current_page',
                    'from',
                    'last_page',
                    'links',
                ]
            ]);
    }

    public function testGetPostById()
    {
        $model = Post::factory()->create();

        $response = $this->get(route('posts.show', ['id' => $model->id]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'content',
                    'featuredImage',
                    'status',
                    'createdAt',
                    'author'     => ['id', 'name'],
                    'tags'       => [
                        '*' => ['id', 'name']
                    ],
                    'categories' => [
                        '*' => ['id', 'name']
                    ],
                ]
            ]);
    }


    public function testCreatePost()
    {
        /** @var Post $model */
        $model = Post::factory()->make();

        $data = [
            'title'         => $model->title,
            'content'       => $model->content,
            'status'        => $model->status,
            'authorId'      => $model->author_id,
            'featuredImage' => $model->featured_image,
            'categoryIds'   => [],
            'tagIds'        => []
        ];

        $response = $this->postJson(
            route('posts.store'),
            $data
        );

        $response->assertOk()
            ->assertJson([
                'message' => "Post created successfully"
            ]);

        $this->assertDatabaseHas($model->getTable(), [
            'title'          => $model->title,
            'content'        => $model->content,
            'status'         => $model->status,
            'author_id'      => $model->author_id,
            'featured_image' => $model->featured_image
        ]);
    }

    public function testUpdatePost()
    {
        $id = Post::factory()->create()->id;
        /** @var Post $model */
        $model = Post::factory()->make();

        $data = [
            'title'         => $model->title,
            'content'       => $model->content,
            'status'        => $model->status,
            'featuredImage' => $model->featured_image,
            'categoryIds'   => [],
            'tagIds'        => []
        ];

        $response = $this->putJson(
            route('posts.update', ['id' => $id]),
            $data
        );

        $response->assertOk()
            ->assertJson([
                'message' => "Post updated successfully"
            ]);

        $this->assertDatabaseHas($model->getTable(), [
            'id'             => $id,
            'title'          => $model->title,
            'content'        => $model->content,
            'status'         => $model->status,
            'featured_image' => $model->featured_image
        ]);
    }

    public function testDeletePost()
    {
        $model = Post::factory()->create();

        $response = $this->delete(
            route('posts.delete', ['id' => $model->id]),
        );

        $response->assertStatus(200)
            ->assertJson([
                'message' => "Post deleted successfully"
            ]);
    }
}
