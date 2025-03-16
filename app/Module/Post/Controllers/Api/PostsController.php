<?php

declare(strict_types=1);

namespace App\Module\Post\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessagesResource;
use App\Module\Post\Commands\CreatePostCommand;
use App\Module\Post\Commands\RemovePostCommand;
use App\Module\Post\Commands\UpdatePostCommand;
use App\Module\Post\Commands\UpdatePostStatusCommand;
use App\Module\Post\Contracts\Services\PostService;
use App\Module\Post\Models\Post;
use App\Module\Post\Requests\CreatePostRequest;
use App\Module\Post\Requests\PostShowRequest;
use App\Module\Post\Requests\UpdatePostRequest;
use App\Module\Post\Resources\PostItemResource;
use App\Module\Post\Resources\PostsResource;
use Illuminate\Auth\Access\AuthorizationException;

final class PostsController extends Controller
{
    public function __construct(private readonly PostService $service)
    {
    }

    /**
     * @OA\Get (
     *     path="/post",
     *     tags={"Post"},
     *     summary="Список",
     *     description="Получить список",
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Номер страницы",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Количество данных для показа",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *
     *     @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     ref="#/components/schemas/PostResource"
     *                 )
     *             )
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     * @throws AuthorizationException
     */
    public function index(PostShowRequest $request): PostsResource
    {
        $this->authorize('index', [Post::class, $request]);

        return new PostsResource(
            $this->service->getAllPost($request->getDTO())
        );
    }

    /**
     * @OA\Get (
     *     path="/post/{id}",
     *     tags={"Post"},
     *     summary="Получить данные по id",
     *     description="Получить данные по id",
     *
     *     @OA\Parameter (ref="#/components/parameters/__id"),
     *
     *     @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     ref="#/components/schemas/PostItemResource"
     *                 )
     *             )
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     * @throws AuthorizationException
     */
    public function show(int $id): PostItemResource
    {
        $this->authorize('show', [Post::class, $id]);

        return new PostItemResource(
            $this->service->getPostById($id)
        );
    }

    /**
     * @OA\Post (
     *     path="/post",
     *     tags={"Post"},
     *     summary="Cоздать",
     *     description="Cоздать",
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/CreatePostRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Post created successfully"),
     *             @OA\Property(property="data", type="object",example=null),
     *             @OA\Property(property="code", type="integer", example=200),
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     * @throws AuthorizationException
     */
    public function store(CreatePostRequest $request): MessagesResource
    {
        $this->authorize('store', [Post::class, $request]);

        $command = new CreatePostCommand($request->getDTO());

        $this->dispatch($command);

        return (new MessagesResource(null))
            ->setMessage('Post created successfully');
    }

    /**
     * @OA\Put (
     *     path="/post/{id}",
     *     tags={"Post"},
     *     summary="Редактировать",
     *     description="Редактировать",
     *
     *     @OA\Parameter (ref="#/components/parameters/__id"),
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/UpdatePostRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Post updated successfully"),
     *             @OA\Property(property="data", type="object",example=null),
     *             @OA\Property(property="code", type="integer", example=200),
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     * @throws AuthorizationException
     */
    public function update(UpdatePostRequest $request): MessagesResource
    {
        $this->authorize('update', [Post::class, $request]);

        $command = new UpdatePostCommand($request->getDTO());

        $this->dispatch($command);

        return (new MessagesResource(null))
            ->setMessage('Post updated successfully');
    }

    /**
     * @OA\Delete (
     *     path="/post/{id}",
     *     tags={"Post"},
     *     summary="Удалить",
     *     description="Удалить",
     *
     *     @OA\Parameter (ref="#/components/parameters/__id"),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Post deleted successfully"),
     *             @OA\Property(property="data", type="object",example=null),
     *             @OA\Property(property="code", type="integer", example=200),
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     * @throws AuthorizationException
     */
    public function destroy(int $id): MessagesResource
    {
        $this->authorize('destroy', [Post::class, $id]);

        $command = new RemovePostCommand($id);

        $this->dispatch($command);

        return (new MessagesResource(null))
            ->setMessage('Post deleted successfully');
    }

    /**
     * @OA\Put (
     *     path="/post/{id}/publish",
     *     tags={"Post"},
     *     summary="Публиковать",
     *     description="Публиковать",
     *
     *     @OA\Parameter (ref="#/components/parameters/__id"),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post published successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Post updated successfully"),
     *             @OA\Property(property="data", type="object",example=null),
     *             @OA\Property(property="code", type="integer", example=200),
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     * @throws AuthorizationException
     */
    public function publish(int $id): MessagesResource
    {
        $this->authorize('publish', [Post::class]);

        $command = new UpdatePostStatusCommand(
            $id,
            Post::STATUS_PUBLISHED
        );

        $this->dispatch($command);

        return (new MessagesResource(null))
            ->setMessage('Post published successfully');
    }
}
