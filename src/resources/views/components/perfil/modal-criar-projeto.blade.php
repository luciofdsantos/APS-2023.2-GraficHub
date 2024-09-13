
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModallabel" aria-hidden="true">



    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Criar projeto</h1>
                <script>
                    function closeModal1() {
                        $('#createProjectModal').modal('hide');
                    }
                </script>
                <button onclick="closeModal1(); resetModal();" type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form  class="forms" action="{{route('project.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6 custom-file-upload" type="text" placeholder="Título" name="titulo" value="{{ old('titulo') }}">

                    </div>
                    @error('titulo')
                    <span class="error-message">{{$message}}</span>
                    @enderror
                    <div id ="body-project-img" class="input-group mb-3">
                        <label class="form-control form-control-lg bg-light fs-6 custom-file-upload" for="cover-file-upload">Capa do projeto<div id="cover-preview-wrapper"></div></label>
                    </div>
                     <input style="visibility: hidden" id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
                    @error('imagem_capa')
                    <span class="error-message">
                {{$message}}
            </span>
                    @enderror
                    <div id ="body-project-img" class="input-group mb-3 ">
                        <label  class="form-control form-control-lg bg-light fs-6 custom-file-upload"  for="body-imgs-upload"> <div id="body-imgs-upload-label-text">Imagens do corpo do projeto</div><div id="images-preview-wrapper"></div></label>
                    </div>
                     <input style="visibility: hidden" id="body-imgs-upload" type="file" name="imagens[]" multiple>
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
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6 custom-file-upload" type="text" placeholder="Ferramentas" name="ferramentas" value="{{ old('ferramentas') }}">
                    </div>
                      @error('ferramentas')
                    <span class="error-message">
                {{$message}}
            </span>
                    @enderror
                    <div class="input-group mb-3">
                        <textarea class="form-control form-control-lg bg-light fs-6 custom-file-upload"  placeholder="Descricao" name="descricao" >{{ old('descricao') }}</textarea>
                    </div>
                    @error('descricao')
                    <span class="error-message">
                {{$message}}
            </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6 custom-file-upload" type="text" placeholder="Tags" name="tags" value="{{ old('tags') }}">
                    </div>
                     @error('tags')
                    <span class="error-message">
                {{$message}}
            </span>
                    @enderror
                    @error('tags.*')
                    <span class="error-message">
                {{$message}}
            </span>
                    @enderror

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02" name="arquivo">
                        <label class="input-group-text" for="inputGroupFile02">Arquivo do Projeto</label>
                    </div>

                    @error('arquivo')
                    <span class="error-message">
                {{$message}}
            </span>
                    @enderror
                    <div class="input-group d-flex justify-content-center">
                        <div class="form-check form-switch ">
                            <input id="flexSwitchCheckDefault" class="form-check-input"  type="checkbox" name="arquivo_publico" {{ old('arquivo_publico') ? 'checked': '' }}>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Visibilidade do Arquivo</label>
                        </div>
                    </div>

                    @error('arquivo_publico')
                    <span class="error-message">
                {{$message}}
            </span>
                    @enderror
                    <div class="modal-footer">
                        <button  class="btn btn-secondary" id="create-project-btn" type="submit">Criar projeto</button>
                    </div>
                </form>
            </div>

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

        // let fileInput = document.getElementById("file-upload");
        // fileInput.addEventListener('change', () => {
        //     if(fileInput.files.length > 0) {
        //         document.getElementById('project-file-upload-label').innerHTML = `<div id="project-file-upload-label-text">Arquivo do projeto</div><div id="file-preview" onmouseover="showFileDeleteMessage()" onmouseout="hideFileDeleteMessage()"><img class="file-icon-create-project" src="/img/file-icon.png">${fileInput.files[0].name}</div>`
        //     }
        //     let filePreview = document.getElementById('file-preview');
        //     filePreview.addEventListener('click', () => {
        //         event.preventDefault();
        //         let dataTransfer = new DataTransfer();
        //         fileInput.files = dataTransfer.files;
        //         document.getElementById('project-file-upload-label').innerHTML = `Arquivo do projeto`
        //     })
        // })

        function showFileDeleteMessage(){
            document.getElementById("project-file-upload-label-text").innerText = "Clique para remover o arquivo"
        }

        function hideFileDeleteMessage(){
            document.getElementById("project-file-upload-label-text").innerText = "Arquivo do projeto"
        }

    </script>
</div>

