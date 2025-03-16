<?php

declare(strict_types=1);

namespace App\Module\Post\Requests;

use App\Module\Post\DTO\CreatePostDTO;
use App\Module\Post\Models\Post;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     required={"authorId", "title", "content", "status"},
 *
 *     @OA\Property(property="authorId", type="integer", example=1, description="ID of the author"),
 *     @OA\Property(property="title", type="string", maxLength=255, example="My Blog Post"),
 *     @OA\Property(property="content", type="string", example="This is the content of the post."),
 *     @OA\Property(property="status", type="integer", enum={1, 2}, example=1, description="1 - draft, 2 - published"),
 *     @OA\Property(property="featuredImage", type="string", format="url", nullable=true, example="https://example.com/image.jpg"),
 *     @OA\Property(
 *         property="categoryIds",
 *         type="array",
 *         nullable=true,
 *         @OA\Items(type="integer", example=1)
 *     ),
 *     @OA\Property(
 *         property="tagIds",
 *         type="array",
 *         nullable=true,
 *         @OA\Items(type="integer", example=5)
 *     )
 * )
 */
final class CreatePostRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'authorId'      => ['required', 'integer', 'exists:users,id'],
            'title'         => ['required', 'string', 'max:255'],
            'content'       => ['required', 'string'],
            'status'        => ['required', 'integer', Rule::in([Post::STATUS_DRAFT, Post::STATUS_PUBLISHED])],
            'featuredImage' => ['nullable', 'string', 'url'],
            'categoryIds'   => ['nullable', 'array'],
            'categoryIds.*' => ['integer', 'exists:categories,id'],
            'tagIds'        => ['nullable', 'array'],
            'tagIds.*'      => ['integer', 'exists:tags,id'],
        ];
    }

    public function messages(): array
    {
        return [];
    }

    public function getDTO(): CreatePostDTO
    {
        return CreatePostDTO::fromRequest($this);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
