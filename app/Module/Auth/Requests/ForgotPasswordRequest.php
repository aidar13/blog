<?php

declare(strict_types=1);

namespace App\Module\Auth\Requests;

use App\Module\Auth\DTO\ForgotPasswordDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema (
 *     required={"email"},
 *
 *     @OA\Property(property="email", type="email", example="email", description="email"),
 * )
 */
final class ForgotPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
        ];
    }

    public function getDTO(): ForgotPasswordDTO
    {
        return ForgotPasswordDTO::fromRequest($this);
    }
}
