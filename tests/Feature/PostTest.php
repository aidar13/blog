<?php

namespace Tests\Feature;

use App\Http\Permissions\PermissionList;
use App\Models\User;
use App\Module\Post\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\PermissionTrait;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use PermissionTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
    }

    public function testGetAllPosts()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->givePermissionToUser($user, PermissionList::POST_MANAGE);

        Post::factory()->count(20)->create();

        $response = $this
            ->actingAs($user)
            ->get(route('posts.index'));

        $response
            ->assertStatus(200)
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
        /** @var User $user */
        $user = User::factory()->create();
        $this->givePermissionToUser($user, PermissionList::POST_MANAGE);

        $model = Post::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('posts.show', ['id' => $model->id]));

        $response
            ->assertStatus(200)
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
        /** @var User $user */
        $user = User::factory()->create();
        $this->givePermissionToUser($user, PermissionList::POST_EDIT);

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

        $response = $this
            ->actingAs($user)
            ->postJson(
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
        /** @var User $user */
        $user = User::factory()->create();
        $this->givePermissionToUser($user, PermissionList::POST_EDIT);

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

        $response = $this
            ->actingAs($user)
            ->putJson(
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
        /** @var User $user */
        $user = User::factory()->create();
        $this->givePermissionToUser($user, PermissionList::POST_DELETE);

        $model = Post::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(
                route('posts.delete', ['id' => $model->id]),
            );

        $response->assertStatus(200)
            ->assertJson([
                'message' => "Post deleted successfully"
            ]);
    }

    public function testPublishPost()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->givePermissionToUser($user, PermissionList::POST_PUBLISH);

        /** @var Post $model */
        $model = Post::factory()->create([
            'status' => Post::STATUS_DRAFT
        ]);

        $response = $this
            ->actingAs($user)
            ->putJson(
                route('posts.publish', ['id' => $model->id])
            );

        $response
            ->assertOk()
            ->assertJson([
                'message' => "Post published successfully"
            ]);

        $this->assertDatabaseHas($model->getTable(), [
            'id'     => $model->id,
            'status' => Post::STATUS_PUBLISHED,
        ]);
    }
}
