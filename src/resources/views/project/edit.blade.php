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
<div class="project-form-container">
    <div class="main">
        <form action="{{ route('project.update', $project->id) }}" method="post" enctype="multipart/form-data">
            <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
            <p class="title"> Atualizar Projeto</p>
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $project->id }}">
            <input type="text" placeholder="Título" name="titulo" value="{{ old('titulo', $project->titulo) }}">
            @error('titulo')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            <label class="custom-file-upload" for="cover-file-upload">Capa do projeto
                <div id="cover-preview-wrapper"></div>
            </label>
            <input id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
            @error('imagem_capa')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            <label class="custom-file-upload" for="body-imgs-upload"><div id="body-imgs-upload-label-text">Imagens do corpo do projeto</div><div id="images-preview-wrapper"></div>
            </label>
            <input id="body-imgs-upload" type="file" name="imagens[]"  multiple>
            @error('imagens')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            @error('imagens.*')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            <input type="text" placeholder="Ferramentas" name="ferramentas"
                   value="{{ old('ferramentas', $project->ferramentas) }}">
            @error('ferramentas')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            <textarea class="textar" placeholder="Descricao"
                      name="descricao">{{ old('descricao', $project->descricao) }}</textarea>
            @error('descricao')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            <input type="text" placeholder="Tags" name="tags" value="{{ old('tags', $project->tags) }}">
            @error('tags')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            <label id="project-file-upload-label" class="custom-file-project-upload" for="file-upload">Arquivo do projeto</label>
            <input id="file-upload" type="file" placeholder="Arquivo do projeto" name="arquivo">
            @error('arquivo')
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror
            <input id="delete-file-project" type="hidden" name="apagar_arquivo" value=''>
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
            <span class="error-message">
                    {{$message}}
                </span>
            @enderror

            <button type="submit">Atualizar</button>

        </form>
    </div>
</div>
<script>
    let project
    let savedImages
    window.addEventListener('load', (event) => {
        project = <?php echo json_encode($project); ?>;
        savedImages=<?php echo json_encode($project->imagesProjects); ?>;
        let path = `/storage/arquivos/${project.user_id}/${project.id}/${project.imagem_capa}`
        document.getElementById('cover-preview-wrapper').innerHTML = `<img class="img-preview" src="${path}" alt="Cover image preview">`

        let imgWrapper = document.getElementById('images-preview-wrapper')
        imgWrapper.innerHTML = "<div class='imgs-preview-wrapper'>";
        for (let i = 0; i < savedImages.length; ++i) {
            let url = `/storage/arquivos/${project.user_id}/${project.id}/imgs/${savedImages[i].name}`
            imgWrapper.innerHTML += `<img class="img-preview" id="image-preview-${i}" src="${url}" alt="image${i}Preview" onmouseover='showDeleteAllMessage()' onmouseout='hideDeleteAllMessage()'>`
        }
        imgWrapper.innerHTML += "</div>"

        // document.getElementById('project-file-upload-wrapper').innerHTML = `<label id="old-project-file-upload-label" class="custom-file-upload" for="file-upload">Arquivo do projeto</label>
        //         <input id="file-upload" type="file" placeholder="Arquivo do projeto" name="arquivo">`
        let projectName = `${project.arquivo}`.slice(11)
        if(project.arquivo){
            document.getElementById('project-file-upload-label').innerHTML = `<div id="project-file-upload-label-text">Arquivo do projeto</div><div id="file-preview" onmouseover="showFileDeleteMessage()" onmouseout="hideFileDeleteMessage()"><img class="file-icon-create-project" src="/img/file-icon.png">${projectName}</div>`
        }
        let filePreview = document.getElementById('file-preview');
        filePreview.addEventListener('click', () => {
            event.preventDefault();
            let dataTransfer = new DataTransfer();
            fileInput.files = dataTransfer.files;
            document.getElementById('project-file-upload-label').innerHTML = `Arquivo do projeto`
            console.log(document.getElementById('delete-file-project').value)
            document.getElementById('delete-file-project').value = 1
            console.log(document.getElementById('delete-file-project').value)
        })
    })

    function showDeleteAllMessage(){
        document.getElementById("body-imgs-upload-label-text").innerText = "Clique para adicionar novas imagens (ao confirmar este procedimento todas as imagens atuais do projeto serão substituídas)"
    }

    function hideDeleteAllMessage(){
        document.getElementById("body-imgs-upload-label-text").innerText = "Imagens do corpo do projeto"
    }

    let coverInput = document.getElementById('cover-file-upload');
    coverInput.addEventListener("change", () =>{
        let imgWrapper = document.getElementById("cover-preview-wrapper");
        imgWrapper.innerHTML = "<div>";
        for(let i = 0; i< coverInput.files.length; ++i){
            let url = URL.createObjectURL(coverInput.files[i])
            imgWrapper.innerHTML += `<img class="img-preview" src="${url}" alt="image${i}Preview">`
        }
        imgWrapper.innerHTML += "</div>"
    } )

    let imgsInput = document.getElementById('body-imgs-upload');
    let files = [];
    imgsInput.addEventListener("change", () =>{
        for(let i = 0; i< imgsInput.files.length; ++i){
            files.push(imgsInput.files[i]);
        }
        let dataTransfer = new DataTransfer();
        for(let i = 0; i< files.length; ++i){
            dataTransfer.items.add(files[i]);
        }
        imgsInput.files = dataTransfer.files;

        let imgWrapper = document.getElementById("images-preview-wrapper");
        if(imgsInput.files.length > 0) {
            imgWrapper.innerHTML = "<div class='imgs-preview-wrapper'>";
            for (let i = 0; i < imgsInput.files.length; ++i) {
                let url = URL.createObjectURL(imgsInput.files[i])
                imgWrapper.innerHTML += `<img class="img-preview" id="image-preview-${i}" src="${url}" alt="image${i}Preview" onclick="removePic(this, event)" onmouseover="showPicDeleteMessage()" onmouseout="hidePicDeleteMessage()">`
            }
            imgWrapper.innerHTML += "</div>"
        }
    } )

    function removePic(imgPreview, event){
        event.preventDefault();
        let i = Number(imgPreview.id.toString().slice(14));
        files = files.filter((file, index) => index !== i)

        let dataTransfer = new DataTransfer();
        for(let i = 0; i< files.length; ++i){
            dataTransfer.items.add(files[i]);
        }
        imgsInput.files = dataTransfer.files;
        let imgWrapper = document.getElementById("images-preview-wrapper");
        if(imgsInput.files.length > 0) {
            imgWrapper.innerHTML = "<div>";
            for (let i = 0; i < imgsInput.files.length; ++i) {
                let url = URL.createObjectURL(imgsInput.files[i])
                imgWrapper.innerHTML += `<img class="img-preview" id="image-preview-${i}" src="${url}" alt="image${i}Preview" onclick="removePic(this, event)" onmouseover="showPicDeleteMessage()" onmouseout="hidePicDeleteMessage()">`
            }
            imgWrapper.innerHTML += "</div>"
        }else{
            imgWrapper.innerHTML = "";
        }
        hidePicDeleteMessage()
    }

    function showPicDeleteMessage(){
        document.getElementById("body-imgs-upload-label-text").innerText = "Clique para remover a imagem"
    }

    function hidePicDeleteMessage(){
        document.getElementById("body-imgs-upload-label-text").innerText = "Imagens do corpo do projeto"
    }

    let fileInput = document.getElementById("file-upload");
    fileInput.addEventListener('change', () => {
        if(fileInput.files.length > 0) {
            document.getElementById('project-file-upload-label').innerHTML = `<div id="project-file-upload-label-text">Arquivo do projeto</div><div id="file-preview" onmouseover="showFileDeleteMessage()" onmouseout="hideFileDeleteMessage()"><img class="file-icon-create-project" src="/img/file-icon.png">${fileInput.files[0].name}</div>`
        }
        let filePreview = document.getElementById('file-preview');
        filePreview.addEventListener('click', () => {
            event.preventDefault();
            let dataTransfer = new DataTransfer();
            fileInput.files = dataTransfer.files;
            document.getElementById('project-file-upload-label').innerHTML = `Arquivo do projeto`
        })
    })

    function showFileDeleteMessage(){
        document.getElementById("project-file-upload-label-text").innerText = "Clique para remover o arquivo"
    }

    function hideFileDeleteMessage(){
        document.getElementById("project-file-upload-label-text").innerText = "Arquivo do projeto"
    }
</script>
</body>

</html>

