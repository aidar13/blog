<?php

declare(strict_types=1);

namespace App\Module\Auth\Requests;

use App\Module\Auth\DTO\ResetPasswordDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema (
 *     required={"email", "token", "password"},
 *
 *     @OA\Property(property="email", type="email", example="email", description="email"),
 *     @OA\Property(property="token", type="string", example="token", description="token"),
 *     @OA\Property(property="password", type="string", example="password", description="password"),
 * )
 */
final class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'exists:users,email'],
            'token'    => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function getDTO(): ResetPasswordDTO
    {
        return ResetPasswordDTO::fromRequest($this);
    }
}
