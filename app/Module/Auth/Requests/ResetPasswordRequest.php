<?php

declare(strict_types=1);

namespace App\Module\Auth\Requests;

use App\Module\Auth\DTO\ResetPasswordDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema (
 *     required={"email"},
 *
 *     @OA\Property(property="email", type="email", example="email", description="email"),
 * )
 */
final class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
        ];
    }

    public function getDTO(): ResetPasswordDTO
    {
        return ResetPasswordDTO::fromRequest($this);
    }
}
