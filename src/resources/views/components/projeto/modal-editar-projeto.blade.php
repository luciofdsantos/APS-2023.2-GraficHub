
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <script>
            function closeModal1() {
                $('#editProjectModal').modal('hide');
            }
    </script>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Projeto</h1>
                <button onclick="closeModal1(); resetModal();" type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form  class="forms" action="{{ route('project.update', $project->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6 custom-file-upload" type="text" placeholder="Título" name="titulo" value="{{ old('titulo', $project->titulo) }}">
                    </div>
                    @error('titulo')
                    <span class="error-message">
                    {{$message}}
                </span>
                    @enderror
                    <label style="color: blue"> *Proporção da imagem 1350px X 1080px (outras proporções irão ocasionar desfiguração na imagem)</label>
                    <div class="input-group">
                         <label class="form-control form-control-lg bg-light fs-6 custom-file-upload" for="cover-file-upload">Capa do projeto
                            <div style="margin-top: 20px" id="cover-preview-wrapper"> </div>
                        </label>
                        @error('imagem_capa')<span class="error-message input-group">{{$message}}</span>@enderror
                    </div>

                    <input  style="visibility: hidden" id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
                    <label style="color: blue"> *Proporção da imagem 1350px X 1080px (outras proporções irão ocasionar desfiguração na imagem)</label>

                    <div   class="input-group">
                         <label class="form-control form-control-lg bg-light fs-6 custom-file-upload" for="body-imgs-upload"><div id="body-imgs-upload-label-text">Imagens do corpo do projeto</div><div id="images-preview-wrapper"></div>
                        </label>
                        @error('imagens')<span class="error-message input-group">{{$message}}</span>@enderror
                        @error('imagens.*')<span class="error-message input-group">{{$message}}</span>@enderror
                    </div>

                    <input style="visibility: hidden" id="body-imgs-upload" type="file" name="imagens[]"  multiple>

                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6 custom-file-upload" type="text" placeholder="Ferramentas" name="ferramentas" value="{{ old('ferramentas', $project->ferramentas) }}">
                    </div>

                    @error('ferramentas')
                    <span class="error-message">
                    {{$message}}
                </span>
                    @enderror
                    <div class="input-group mb-3">
                        <textarea class="form-control form-control-lg bg-light fs-6 custom-file-upload" type="text" placeholder="Descricao" name="descricao">{{ old('descricao', $project->descricao) }}</textarea>
                    </div>

                    @error('descricao')
                    <span class="error-message">
                    {{$message}}
                </span>
                    @enderror
                    <label style="color: blue"> *Separe as Tags por espaço</label>
                    <div class="input-group mb-3">
                        <input  class="form-control form-control-lg bg-light fs-6 custom-file-upload" type="text" placeholder="Tags" name="tags" value="{{ old('tags', $project->tags) }}">
                    </div>

                    @error('tags')
                    <span class="error-message">
                    {{$message}}
                </span>
                    @enderror

                    <div class="input-group mb-3">
                        <label id="project-file-upload-label"  class="form-control form-control-lg bg-light fs-6 custom-file-upload" for="file-upload">Arquivo do projeto</label>
                    </div>
                        <input style="visibility: hidden"  id="file-upload" type="file" placeholder="Arquivo do projeto" name="arquivo">
                    @error('arquivo')
                    <span class="error-message">
                    {{$message}}
                </span>
                    @enderror
                    <input id="delete-file-project" type="hidden" name="apagar_arquivo" value=''>
                    <div class="input-group d-flex justify-content-center">
                        <div class="form-check form-switch ">
                            <input id="flexSwitchCheckDefault" class="form-check-input"  type="checkbox" name="arquivo_publico" {{ $project->arquivo_publico ? 'checked' : '' }} >
                            <label class="form-check-label" for="flexSwitchCheckDefault">Visibilidade do Arquivo</label>
                        </div>
                    </div>

                    @error('arquivo_publico')
                    <span class="error-message">
                    {{$message}}
                </span>
                    @enderror
                    <div class="modal-footer">
                        <button  class="btn btn-secondary"  type="submit">Atualizar</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">

            </div>
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
                document.getElementById('project-file-upload-label').innerHTML = `<div id="project-file-upload-label-text">Arquivo do projeto</div><div id="file-preview" onmouseover="showFileDeleteMessage()" onmouseout="hideFileDeleteMessage()">${projectName}</div>`
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
                document.getElementById('project-file-upload-label').innerHTML = `<div id="project-file-upload-label-text">Arquivo do projeto</div><div id="file-preview" onmouseover="showFileDeleteMessage()" onmouseout="hideFileDeleteMessage()">${fileInput.files[0].name}</div>`
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
</div>
