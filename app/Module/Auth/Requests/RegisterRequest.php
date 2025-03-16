<?php

declare(strict_types=1);

namespace App\Module\Auth\Requests;

use App\Module\Auth\DTO\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema (
 *     required={"name", "email", "password"},
 *
 *     @OA\Property(property="name", type="string", example="name", description="name"),
 *     @OA\Property(property="email", type="email", example="email", description="email"),
 *     @OA\Property(property="password", type="string", example="password", description="password"),
 * )
 */
final class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function getDTO(): RegisterDTO
    {
        return RegisterDTO::fromRequest($this);
    }
}
