<?php

declare(strict_types=1);

namespace App\Module\User\Requests;

use App\Module\User\DTO\UserShowDTO;
use Illuminate\Foundation\Http\FormRequest;

final class UserShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'limit' => ['nullable', 'integer'],
            'page'  => ['nullable', 'integer'],
            'name'  => ['nullable', 'string', 'max:255'],
        ];
    }

    public function getDTO(): UserShowDTO
    {
        return UserShowDTO::fromRequest($this);
    }
}
