<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class ProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'max:100'],
            'imagem_capa' => ['required', 'image', 'max:5120'],
            'imagens' => ['required', 'array', 'min:1', 'max:6', 'nullable'],
            'ferramentas' => ['required'],
            'descricao' => ['required'],
            'tags' => ['required'],
            'arquivo' => ['file'],
            'arquivo_publico' => []
        ];
    }

    public function messages(): array
    {
        return [
            'titulo' => [
                'required' => 'Preencha este campo',
                'max' => 'O campo excede o limite de :max caracteres.',
            ],
            'imagem_capa' => [
                'required' => 'Selecione a imagem da capa',
                'image' => 'O arquivo deve ser uma imagem (jpg, jpeg, png, bmp, gif, svg ou webp).',
                'max' => 'O tamanho máximo do arquivo é :max KB.'
            ],
            'imagens' => [
                'required' => 'Selecione pelo menos uma imagem',
                'max' => 'Selecione no máximo 6 imagens',
                'min' => 'Selecione pelo menos uma imagem'
            ],
            'ferramentas' => [
                'required' => 'Preencha este campo'
            ],
            'descricao' => [
                'required' => 'Preencha este campo'
            ],
            'tags' => [
                'required' => 'Digite pelo menos uma tag'
            ],
            'arquivo' => [
                'file' => 'O upload precisa ser de um arquivo'
            ],
            'arquivo_publico' => [
            ]
        ];
    }
}
