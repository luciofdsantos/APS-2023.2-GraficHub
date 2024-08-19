@extends('nonav')

@section('content')


    <div class="main">
        <form action="{{route('project.store')}}" method="post" enctype="multipart/form-data">
            <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
            @csrf
            <input type="text" placeholder="Título" name="titulo">
            @error('titulo')
            <span>
                {{$message}}
            </span>
            @enderror
            <label class ="custom-file-upload" for="cover-file-upload">Capa do projeto</label>
            <input id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
            @error('imagem_capa')
            <span>
                {{$message}}
            </span>
            @enderror
            <label  class ="custom-file-upload" for="body-imgs">Imagens do corpo do projeto</label>
            <input id="body-imgs" type="file" name="imagens[]" multiple>

            @error('imagens')
            <span>
                {{$message}}
            </span>
            @enderror
            @error('imagens.*')
            <span>
                {{$message}}
            </span>
            @enderror
            <input type="text" placeholder="Ferramentas" name="ferramentas">
            @error('ferramentas')
            <span>
                {{$message}}
            </span>
            @enderror
            <textarea class="textar" placeholder="Descricao" name="descricao"></textarea>
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
            <label class ="custom-file-upload" for="file-upload">Arquivo do projeto</label>
            <input id="file-upload" type="file" placeholder="Arquivo do projeto" name="arquivo">
            @error('arquivo')
            <span>
                {{$message}}
            </span>
            @enderror
            <div class="custom-check">
                <p>Tornar arquivo privado?</p>
                <div class="checkbox-wrapper-55">
                    <label class="rocker rocker-small">
                        <input type="checkbox">
                        <span class="switch-left">Yes</span>
                        <span class="switch-right">No</span>
                    </label>
                </div>
            </div>



            @error('arquivo_publico')
            <span>
                {{$message}}
            </span>
            @enderror

            <button type="submit">Criar projeto</button>
        </form>
    </div>
@endsection
