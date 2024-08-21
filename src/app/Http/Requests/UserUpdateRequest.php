<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $oldData = User::find(auth()->id());
        $rules = [];

        if ($this->input('email') != $oldData->email) {
            $rules['email'] = ['required', 'email', 'string', 'max:255', 'unique:users'];
        }
        if ($this->input('apelido') != $oldData->apelido) {
            $rules['apelido'] = ['required', 'string', 'max:255', 'unique:users'];
        }
        if ($this->input('nome') != $oldData->name) {
            $rules['nome'] = ['required', 'string', 'max:255'];
        }
        if ($this->input('numero_telefone') != $oldData->numero_telefone) {
            $rules['numero_telefone'] = ['required', 'unique:users', 'regex:/^(\+?\d{1,4}[\s-]?)?\(?\d{1,4}\)?[\s-]?\d{1,4}[\s-]?\d{1,9}$/'];
        }
        if ($this->input('password') != null) {
            $rules['password'] = ['required', 'confirmed', 'min:8'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email' => [
                'required' => 'Preencha este campo.',
                'email' => 'Insira um e-mail válido.',
                'unique' => 'E-mail já cadastrado.',
                'max' => 'O campo excede o limite de :max caracteres.'
            ],
            'nome' => [
                'required' => 'Preencha este campo.',
                'max' => 'O campo excede o limite de :max caracteres.'
            ],
            'password' => [
                'required' => 'Preencha este campo.',
                'min' => 'A senha deve ter no mínimo :min caracteres.',
                'confirmed' => 'A confirmação de senha deve ser idêntica a senha.',
            ],
            'apelido' => [
                'required' => 'Preencha este campo.',
                'unique' => 'Apelido já cadastrado.',
                'max' => 'O campo excede o limite de :max caracteres.',
            ],
            'numero_telefone' => [
                'required' => 'Preencha este campo.',
                'unique' => 'Número de telefone já cadastrado.',
                'regex' => 'Formato do número de telefone inválido.'
            ]
        ];
    }
}
