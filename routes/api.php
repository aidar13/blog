<?php

use App\Module\Auth\Controllers\Api\AuthController;
use App\Module\Post\Controllers\Api\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login');

Route::post('/register', [AuthController::class, 'register'])
    ->name('api.register');

Route::post('/password/forgot', [AuthController::class, 'forgotPassword'])
    ->name('password.forgot');

Route::post('/password/reset', [AuthController::class, 'resetPassword'])
    ->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

     Route::get('/posts', [PostsController::class, 'index'])
        ->name('posts.index');
     Route::get('/posts/{id}', [PostsController::class, 'show'])
        ->name('posts.show');
     Route::post('/posts', [PostsController::class, 'store'])
        ->name('posts.store');
     Route::put('/posts/{id}', [PostsController::class, 'update'])
        ->name('posts.update');
     Route::put('/posts/{id}/publish', [PostsController::class, 'publish'])
        ->name('posts.publish');
    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])
        ->name('posts.delete');
});
