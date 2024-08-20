<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>
    <link href="/css/login.css" rel="stylesheet">
</head>
<body>

<div class="main">
    <form action="{{ route('project.update', $project->id) }}" method="post" enctype="multipart/form-data">
        <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
        <p class="title"> Atualizar Dados</p>
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $project->id }}">
        <input type="text" placeholder="Título" name="titulo" value="{{ old('titulo', $project->titulo) }}">
        @error('titulo')
        <span>
                {{$message}}
            </span>
        @enderror
        <label class="custom-file-upload" for="cover-file-upload">Capa do projeto
            <div id="cover-preview-wrapper"></div>
        </label>
        <input id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
        @error('imagem_capa')
        <span>
                {{$message}}
            </span>
        @enderror
        <label class="custom-file-upload" for="body-imgs-upload">Imagens do corpo do projeto
            <div id="images-preview-wrapper"></div>
        </label>
        <input id="body-imgs-upload" type="file" name="imagens[]" multiple>
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
        <input type="text" placeholder="Ferramentas" name="ferramentas"
               value="{{ old('ferramentas', $project->ferramentas) }}">
        @error('ferramentas')
        <span>
                {{$message}}
            </span>
        @enderror
        <textarea class="textar" placeholder="Descricao"
                  name="descricao">{{ old('descricao', $project->descricao) }}</textarea>
        @error('descricao')
        <span>
                {{$message}}
            </span>
        @enderror
        <input type="text" placeholder="Tags" name="tags" value="{{ old('tags', $project->tags) }}">
        @error('tags')
        <span>
                {{$message}}
            </span>
        @enderror
        <label class="custom-file-upload" for="file-upload">Arquivo do projeto</label>
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
                    <input type="checkbox" name="arquivo_publico" {{ $project->arquivo_publico ? 'checked' : '' }} >
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

        <button type="submit">Atualizar</button>

    </form>
</div>
<script>
    let img = document.getElementById('body-imgs-upload');
    img.addEventListener("change", () => {
        let imgWrapper = document.getElementById("images-preview-wrapper");
        imgWrapper.innerHTML = "<div>";
        for (let i = 0; i < img.files.length; ++i) {
            let url = URL.createObjectURL(img.files[i])
            imgWrapper.innerHTML += `<img class="img-preview" src="${url}" alt="image${i}Preview">`
        }
        imgWrapper.innerHTML += "</div>"
    })

    let cover = document.getElementById('cover-file-upload');
    cover.addEventListener("change", () => {
        let imgWrapper = document.getElementById("cover-preview-wrapper");
        imgWrapper.innerHTML = "<div>";
        for (let i = 0; i < cover.files.length; ++i) {
            let url = URL.createObjectURL(cover.files[i])
            imgWrapper.innerHTML += `<img class="img-preview" src="${url}" alt="image${i}Preview">`
        }
        imgWrapper.innerHTML += "</div>"
    })
</script>
</body>

</html>

