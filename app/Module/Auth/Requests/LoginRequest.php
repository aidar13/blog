<?php

declare(strict_types=1);

namespace App\Module\Auth\Requests;

use App\Module\Auth\DTO\LoginDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema (
 *     required={"email", "password"},
 *
 *     @OA\Property(property="email", type="email", example="email", description="email"),
 *     @OA\Property(property="password", type="string", example="password", description="password"),
 * )
 */
final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function getDTO(): LoginDTO
    {
        return LoginDTO::fromRequest($this);
    }
}
