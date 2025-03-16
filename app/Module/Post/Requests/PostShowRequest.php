<?php

declare(strict_types=1);

namespace App\Module\Post\Requests;

use App\Module\Post\DTO\PostShowDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostShowRequest.
 *
 * @package namespace App\Module\Post\Requests;
 */
final class PostShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function getDTO(): PostShowDTO
    {
        return PostShowDTO::fromRequest($this);
    }
}
