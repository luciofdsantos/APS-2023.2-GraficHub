<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comentario' => ['required', 'string', 'min:3', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'comentario' => [
                'required' => 'O campo de comentário é obrigatório.',
                'string' => 'O comentário deve ser um texto válido.',
                'min' => 'O comentário deve ter pelo menos :min caracteres.',
                'max' => 'O comentário não pode exceder :max caracteres.',
            ],
        ];
    }
}
