<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
        $oldData = Project::find($this->input('id'));
        $rules = [];

        if ($this->input('titulo') != $oldData->titulo) {
            $rules['titulo'] = ['required', 'max:100'];
        }
        if ($this->input('descricao') != $oldData->descricao) {
            $rules['descricao'] = ['required'];
        }
        if ($this->input('ferramentas') != $oldData->ferramentas) {
            $rules['ferramentas'] = ['required'];
        }
        if($this->file('imagem_capa') != null){
            $rules['imagem_capa'] = ['image', 'max:5120'];
        }
        if($this->file('arquivo') != null){
            $rules['arquivo'] = ['file'];
        }
        if($this->file('imagens') != null){
            $rules['imagens'] = ['max:6'];
        }
        $rules['tags'] = ['required', 'max:255'];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'titulo' => [
                'required' => 'Preencha este campo',
                'max' => 'O campo excede o limite de :max caracteres.',
            ],
            'imagem_capa' => [
                'image' => 'O arquivo deve ser uma imagem (jpg, jpeg, png, bmp, gif, svg ou webp).',
                'max' => 'O tamanho máximo do arquivo é :max KB.'
            ],
            'imagens' => [
                'max' => 'Selecione no máximo 6 imagens',
            ],
            'ferramentas' => [
                'required' => 'Preencha este campo'
            ],
            'descricao' => [
                'required' => 'Preencha este campo'
            ],
            'tags' => [
                'required' => 'Digite pelo menos uma tag',
                'max' => 'O tamanho máximo das tags é de :max caracteres.'
            ],
            'arquivo' => [
                'file' => 'O upload precisa ser de um arquivo'
            ],
        ];
    }
}
