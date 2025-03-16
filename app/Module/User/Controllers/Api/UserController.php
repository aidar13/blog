<?php

declare(strict_types=1);

namespace App\Module\User\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Module\User\Contracts\Services\UserService;
use App\Module\User\Requests\UserShowRequest;
use App\Module\User\Resources\ProfileResource;
use App\Module\User\Resources\UsersResource;
use Illuminate\Support\Facades\Auth;

final class UserController extends Controller
{
    public function __construct(private readonly UserService $service)
    {
    }

    /**
     * @OA\Get (
     *     path="/users",
     *     summary="Список пользователей",
     *     operationId="usersIndex",
     *     tags={"User"},
     *
     *     @OA\Parameter (ref="#/components/parameters/__page"),
     *     @OA\Parameter (ref="#/components/parameters/__limit"),
     *     @OA\Parameter (ref="#/components/parameters/__sort"),
     *
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         description="Имя сотрудника",
     *         @OA\Schema(type="string", example="Хаким")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/UserResource")
     *         )
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     */
    public function index(UserShowRequest $request): UsersResource
    {
        return new UsersResource(
            $this->service->getAllPaginated($request->getDTO())
        );
    }

    /**
     * @OA\Get (
     *     path="/me",
     *     summary="Получение данные пользователя",
     *     operationId="me",
     *     tags={"User"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Информация пользователя получен.",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     ref="#/components/schemas/ProfileResource"
     *                 )
     *             )
     *         ),
     *     ),
     * )
     */
    public function me(): ProfileResource
    {
        return (new ProfileResource($this->service->getById(Auth::id())))
            ->setMessage(trans('message.user.me'));
    }
}
