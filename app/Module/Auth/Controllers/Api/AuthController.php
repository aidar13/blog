<?php

declare(strict_types=1);

namespace App\Module\Auth\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessagesResource;
use App\Module\Auth\Commands\LoginCommand;
use App\Module\Auth\Commands\LogoutCommand;
use App\Module\Auth\Commands\RegisterCommand;
use App\Module\Auth\Requests\LoginRequest;
use App\Module\Auth\Requests\RegisterRequest;
use App\Module\Auth\Resources\LoginResource;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{

    /**
     * @OA\Post (
     *     path="/login",
     *     summary="Получение токена",
     *     operationId="login",
     *     tags={"Auth"},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/LoginRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Login success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     ref="#/components/schemas/LoginResource"
     *                 )
     *             )
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     */
    public function login(LoginRequest $request): LoginResource
    {
        $tokenDTO = dispatch_sync(new LoginCommand(
            $request->getDTO()
        ));

        return (new LoginResource($tokenDTO))
            ->setMessage('Login success');
    }

    /**
     * @OA\Post (
     *     path="/register",
     *     summary="Register",
     *     operationId="Register",
     *     tags={"Auth"},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/RegisterRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Register success",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Register success"),
     *             @OA\Property(property="data", type="object",example=null),
     *             @OA\Property(property="code", type="integer", example=200),
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     */
    public function register(RegisterRequest $request): MessagesResource
    {
        dispatch_sync(new RegisterCommand(
            $request->getDTO()
        ));

        return (new MessagesResource(null))
            ->setMessage('Register success');
    }

    /**
     * @OA\Post (
     *     path="/logout",
     *     summary="logout",
     *     operationId="logout",
     *     tags={"Auth"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Logout success",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Logout success"),
     *             @OA\Property(property="data", type="object",example=null),
     *             @OA\Property(property="code", type="integer", example=200),
     *         ),
     *     ),
     *     security={{
     *         "apiKey":{}
     *     }}
     * )
     */
    public function logout(): MessagesResource
    {
        dispatch(new LogoutCommand(
            (int)Auth::id()
        ));

        return (new MessagesResource(null))
            ->setMessage('Logout success');
    }
}
