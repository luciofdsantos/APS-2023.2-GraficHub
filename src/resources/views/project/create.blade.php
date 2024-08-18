@extends('nonav')

@section('content')


    <div>
        <form action="{{route('project.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Título" name="titulo">
            @error('titulo')
            <span>
                {{$message}}
            </span>
            @enderror
            <label for="cover-file-upload">Capa do projeto</label>
            <input id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
            @error('imagem_capa')
            <span>
                {{$message}}
            </span>
            @enderror
            <label for="body-imgs">Imagens do corpo do projeto</label>
            <input id="body-imgs" type="file" name="imagens[]" multiple>
            <input type="text" placeholder="Ferramentas" name="ferramentas">
            @error('ferramentas')
            <span>
                {{$message}}
            </span>
            @enderror
            <textarea placeholder="Descricao" name="descricao"></textarea>
            @error('descricao')
            <span>
                {{$message}}
            </span>
            @enderror
            <input type="text" placeholder="Tags" name="tags">
            @error('tags')
            <span>
                {{$message}}
            </span>
            @enderror
            <label for="file-upload">Arquivo do projeto</label>
            @error('arquivo')
            <span>
                {{$message}}
            </span>
            @enderror
            <input id="file-upload" type="file" placeholder="Arquivo do projeto" name="arquivo">
            <input type="checkbox" name="arquivo_publico">
            @error('arquivo_publico')
            <span>
                {{$message}}
            </span>
            @enderror
            <label>Tornar arquivo privado?</label>
            <button type="submit">Criar projeto</button>
        </form>
    </div>
@endsection
