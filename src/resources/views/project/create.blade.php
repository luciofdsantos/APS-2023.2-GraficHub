<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>
    <link href="/css/login.css" rel ="stylesheet">
</head>
<body>

<div class="project-form-container">
    <div class="main">
        <form action="{{route('project.store')}}" method="post" enctype="multipart/form-data">
            <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
            <p class="title">Criar Projeto</p>
            @csrf
            <input type="text" placeholder="Título" name="titulo" value="{{ old('titulo') }}">
            @error('titulo')
            <span>
                {{$message}}
            </span>
            @enderror
            <label class ="custom-file-upload" for="cover-file-upload">Capa do projeto<div id="cover-preview-wrapper"></div></label>
            <input id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
            @error('imagem_capa')
            <span>
                {{$message}}
            </span>
            @enderror
            <label  class ="custom-file-upload" for="body-imgs-upload"><div id="body-imgs-upload-label-text">Imagens do corpo do projeto</div><div id="images-preview-wrapper"></div></label>
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
            <input type="text" placeholder="Ferramentas" name="ferramentas" value="{{ old('ferramentas') }}">
            @error('ferramentas')
            <span>
                {{$message}}
            </span>
            @enderror
            <textarea class="textar" placeholder="Descricao" name="descricao" >{{ old('descricao') }}</textarea>
            @error('descricao')
            <span>
                {{$message}}
            </span>
            @enderror
            <input type="text" placeholder="Tags" name="tags" value="{{ old('tags') }}">
            @error('tags')
            <span>
                {{$message}}
            </span>
            @enderror
            <label id="project-file-upload-label" class ="custom-file-project-upload" for="file-upload">Arquivo do projeto</label>
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
                        <input type="checkbox" name="arquivo_publico" {{ old('arquivo_publico') ? 'checked': '' }}>
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

            <button id="create-project-btn" type="submit">Criar projeto</button>
        </form>
    </div>
</div>
    <script >
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
