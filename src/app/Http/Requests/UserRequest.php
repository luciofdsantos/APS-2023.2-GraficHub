<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'apelido' => ['required', 'string', 'max:255', 'unique:users'],
            'nome' => ['required', 'string', 'max:255'],
            'numero_telefone' => ['required', 'unique:users', 'regex:/^(\+?\d{1,4}[\s-]?)?\(?\d{1,4}\)?[\s-]?\d{1,4}[\s-]?\d{1,9}$/'],
            'foto' => ['image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'email' => [
                'required' => 'Preencha este campo.',
                'email' => 'Insira um e-mail válido.',
                'unique' => 'E-mail já cadastrado.'
            ],
            'nome' => [
                'required' => 'Preencha este campo.',
            ],
            'password' => [
                'required' => 'Preencha este campo.',
                'min' => 'A senha deve ter no mínimo :min caracteres.',
                'confirmed' => 'A confirmação de senha deve ser idêntica a senha.',
            ],
            'apelido' => [
                'required' => 'Preencha este campo.',
                'unique' => 'Apelido já cadastrado.',
            ],
            'numero_telefone' => [
                'required' => 'Preencha este campo.',
                'unique' => 'Número de telefone já cadastrado.',
                'regex' => 'Formato do número de telefone inválido.'
            ],
            'image' => [
                'image' => 'O arquivo deve ser uma imagem (jpg, jpeg, png, bmp, gif, svg ou webp).',
//                'mimes' => 'O arquivo deve ser jpg, jpeg ou png.',
                'max' => 'O tamanho máximo do arquivo é 2048 KB.'
            ]
        ];
    }
}
