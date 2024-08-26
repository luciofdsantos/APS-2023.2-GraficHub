
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>

    <link href="/img/logo.png" rel ="icon">
    <link href="/css/navbar.css" rel ="stylesheet">
    <link href="/css/login.css" rel ="stylesheet">
    <link href="/css/dialog.css" rel ="stylesheet">
    <link href="/css/perfil.css" rel ="stylesheet">
    <link href="/css/project.css" rel ="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<header class="nav-bar-wrapper mainshadowdown">
    <div class="logo-wrapper">
        <a href="{{ route('home') }}"> <img class="logo-img" src="/img/logo.png" alt="grafic hub logo"/> </a>
        <a href="{{ route('home') }}"> <img class="logo-text-img" src="/img/logo_text.png" alt="grafic hub logo"/> </a>
    </div>
    <div class="profile-wrapper">
        <img class="search-icon" src="/img/search-img.png" alt="search-icon" />
        <a href="{{ auth()->check() ? route('user.perfil', auth()->user()->apelido) : route('auth.loginForm') }}" class = "text">
            <div class="profile-pic-wrapper">
                <div class="profile-pic-wrapper">
                    @if(auth()->check() && auth()->user()->foto != null)
                        <img class="profile-pic" src="{{ asset('storage/arquivos/'. auth()->id() . '/' . auth()->user()->foto) }}" alt="profile pic" />
                    @else
                        <img class="profile-icon" src="/img/profile-img.png" alt="profile pic" />
                    @endif
                </div>
            </div>
            <div>
                @if(auth()->check())
                    {{ auth()->user()->apelido }}
                @else
                    Entrar/Cadastrar
                @endif
            </div>
        </a>
    </div>
</header>

    <body>
    <div class="main-content">
    <div class = "sideBar mainperfil">
        <div class = "user mainperfil">
            @if($user['foto'] != null)
                <img class="userImg mainperfil" src="{{ asset('storage/arquivos/'. $user['id'] . '/' . $user['foto']) }}">
            @else
                <img class="userImg mainperfil" src="/img/profile-img.png" alt="profile pic" />
            @endif
            <div class="userInfo mainperfil">
                <p class="name mainperfil">{{ $user['nome'] }} </p>
                <p class="apelido mainperfil">{{ $user['apelido']}}</p>
            </div>
        </div>

        <form action="{{route('user.seguidores', $user['apelido'])}}" method="get">
            <button class="userFollowers" type="submit"> Seguidores {{ $user->seguidores()->count() }}</button>
        </form>

        <form action="{{route('user.seguindo', $user['apelido'])}}" method="get">
                <button  class="userFollowers" type="submit"> Seguindo {{ $user->seguindo()->count() }}</button>
        </form>

        @if(auth()->id() == $user['id'])
        <form action="{{route('user.updateDisp', $user['id'])}}" method="post">
            @csrf
            @if($user['disponivel'])
                <button type="submit" class="disp-btn green-disp-btn">Disponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></button>
            @else
                <button  type="submit" class="disp-btn red-disp-btn">Indisponível <img class="disp-info-icon" src="/img/info-icon.png"  onmouseover="showMessage()" onmouseout="hideMessage()"> </button>
            @endif
            <div id="disp-info-text">
            </div>
        </form>
        @endif



        <div class="mainperfil options">
        </div>
        @if(auth()->id() == $user['id'])
        <button id = "btn-edit-profile" class="edit mainshadowdown">Editar Perfil</button>
        <a class="logout mainshadowdown" onclick="confirmLogout(event)" href ="{{route('auth.logout')}}">LogOut</a>
        @else
            @if(!auth()->check() || !auth()->user()->isSeguindo($user['id']))
                <form id="follow" method="post" action="{{ route('user.follow', $user['id']) }}" >
                    @csrf
                    <button type="submit">Follow</button>
                </form>
            @else
                <form id="unfollow" method="post" action="{{ route('user.unfollow', $user['id']) }}" >
                    @csrf
                    <button type="submit">Unfollow</button>
                </form>
            @endif
        @endif

    </div>
    <div class="portifolio mainperfil mainshadowdown">
        @if(auth()->id() == $user['id'])
            <button class="mainshadowdown portBox" id="btn-create-project">+</button>
        @endif
            <div class="project-box">
                @foreach($projects as $project)
                    <div class=" mainshadowdown card">
                        <img src="{{ asset('storage/arquivos/'. $user['id'] . '/' . $project->id . '/' . $project->imagem_capa)}}">
                        <a href="{{ route('project.show', $project->id) }}" class="card__content">
                            <p class="card__title "> <heavy>{{ Str::limit(Str::title($project->titulo), 25) }}</heavy> </p>
                            <div class="block-with-text"> <p class="card__description">{{ Str::limit(Str::title($project->descricao), 80) }}</p></div>
                            <div class="card__description"> <p>Curtidas 000  Salvos 000</p></div>
                           </a>
                    </div>
                @endforeach
            </div>
        <div class="empt"> {{ $projects->links() }} </div>
    </div>
    <script src="/js/functions.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
        <script src="/js/perfil.js"></script>
    </div>
    <dialog id="box-create-project">

    <div class="project-form-container">
        <div class="main">
            <form  class="forms" action="{{route('project.store')}}" method="post" enctype="multipart/form-data">
                <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
                <p class="title">Criar Projeto</p>
                @csrf
                <input type="text" placeholder="Título" name="titulo" value="{{ old('titulo') }}">
                @error('titulo')
                <span class="error-message">
                {{$message}}
            </span>
                @enderror
                <label class ="custom-file-upload" for="cover-file-upload">Capa do projeto<div id="cover-preview-wrapper"></div></label>
                <input id="cover-file-upload" type="file" placeholder="Imagem da capa do projeto" name="imagem_capa">
                @error('imagem_capa')
                <span class="error-message">
                {{$message}}
            </span>
                @enderror
                <label  class ="custom-file-upload" for="body-imgs-upload"><div id="body-imgs-upload-label-text">Imagens do corpo do projeto</div><div id="images-preview-wrapper"></div></label>
                <input id="body-imgs-upload" type="file" name="imagens[]" multiple>
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
                <input type="text" placeholder="Ferramentas" name="ferramentas" value="{{ old('ferramentas') }}">
                @error('ferramentas')
                <span class="error-message">
                {{$message}}
            </span>
                @enderror
                <textarea class="textar" placeholder="Descricao" name="descricao" >{{ old('descricao') }}</textarea>
                @error('descricao')
                <span class="error-message">
                {{$message}}
            </span>
                @enderror
                <input type="text" placeholder="Tags" name="tags" value="{{ old('tags') }}">
                @error('tags')
                <span class="error-message">
                {{$message}}
            </span>
                @enderror
                <label id="project-file-upload-label" class ="custom-file-project-upload" for="file-upload">Arquivo do projeto</label>
                <input id="file-upload" type="file" placeholder="Arquivo do projeto" name="arquivo">
                @error('arquivo')
                <span class="error-message">
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
                <span class="error-message">
                {{$message}}
            </span>
                @enderror

                <button id="create-project-btn" type="submit">Criar projeto</button>
                <p class="message"><a href="{{ route('user.perfil', $user->apelido) }}">Voltar para o Perfil</a></p>
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
    </dialog>

    <dialog id = "box-edit-profile">
        <div class="user-form-container">
            <div class="main">
                <form class="forms" action="{{ route('user.update', $user['apelido']) }}" method="post" enctype="multipart/form-data">
                    <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
                    <p class="title"> Atualizar Dados</p>
                    @csrf
                    @method('PUT')
                    <input class="mainshadowdown" type="text" placeholder="nome" name="nome"
                           value="{{ old('nome', $user['nome']) }}">
                    @error('nome')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <input class="mainshadowdown" type="text" placeholder="apelido" name="apelido"
                           value="{{ old('apelido', $user['apelido']) }}">
                    @error('apelido')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <input class="mainshadowdown" type="text" placeholder="número de telefone" name="numero_telefone"
                           value="{{ old('numero_telefone', $user['numero_telefone']) }}">
                    @error('numero_telefone')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <input class="mainshadowdown" type="text" placeholder="email" name="email"
                           value="{{ old('email', $user['email']) }}">
                    @error('email')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <input class="mainshadowdown" type="password" placeholder="Nova senha" name="password">
                    @error('password')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <input class="mainshadowdown" type="password" placeholder="confirme a nova senha" name="password_confirmation">
                    <label class="mainshadowdown custom-file-upload" for="file-upload">Foto de Perfil</label>
                    <input id="file-upload" type="file" name="foto" placeholder="Foto de Perfil">
                    @error('foto')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <button class="mainshadowdown" type="submit">Atualizar</button>
                    <p class="message"><a href="{{ route('user.perfil', $user['apelido']) }}">Voltar para o Perfil</a></p>
                </form>
            </div>
        </div>
    </dialog>
    <dialog id="box-show-followers">
        <div class="followe-box">
            @foreach($followers as $follower)
                <div style="margin-bottom: 10px;">
                    <p>{{ $follower->apelido }}</p>
                    @if(auth()->id() != $follower->id)
                        @if(!auth()->check() || !auth()->user()->isSeguindo($follower->id))
                            <form action="{{ route('user.follow', $follower->id) }}" method="post">
                                @csrf
                                <button type="submit">Follow</button>
                            </form>
                        @else
                            <form action="{{ route('user.unfollow', $follower->id) }}" method="post">
                                @csrf
                                <button type="submit">Unfollow</button>
                            </form>
                        @endif
                    @endif
                </div>
            @endforeach
            {{ $followers->links() }}
        </div>
    </dialog>

    </body>

</html>



