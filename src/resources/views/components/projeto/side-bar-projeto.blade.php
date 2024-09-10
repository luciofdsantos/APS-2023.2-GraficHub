<!--
<div class = "sideBar">
    <div class="user main-user">
        @if(auth()->id() != $project->user_id)
            <a class="user mainperfil" href="">

                <div class="userInfo main-user">
                    <p class="name main-user">{{ $project->user->nome }} </p>
                    <p class="apelido main-user"></p>
                </div>
            </a>
        @endif
    </div>
    <div class = "sideContent">



        <div class="descript">
            <h2><strong>Descrição:</strong></h2>
            <p> </p>
        </div>
        <div class="descript">
            <p><strong>Ferramentas:</strong> </p>
        </div>
        <div class="descript">
            <p><strong>Tags:</strong> </p>
        </div>

        <button onclick="openModal('comment-modal')" class="edit-project" >Comentários </button>




<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
Button with data-bs-target
</button>
</div>
</div>
-->

<div class=" d-flex flex-column flex-shrink-0 p-3  text-bg-dark"  style=" overflow-y: auto;height: 100vh;width: 280px;">
    <div style="margin-top:70px;">
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <p class="nav-item text-white">
                <h4 style="font-size: 16px">Título</h4>
                <strong style="font-size: 20px">{{ Str::title($project->titulo) }}</strong>
            </p>
        </li>
        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseDescriptoon" role="button" aria-expanded="false" aria-controls="collapseExample">
                Descrição
            </a>
            <div class="collapse" id="collapseDescriptoon">
                <div class="card card-body text-black" style=" max-height: 25vh;overflow-y: auto; text-align: justify">
                    {{ $project->descricao }}
                </div>
            </div>
        </li>
        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseFerramentas" role="button" aria-expanded="false" aria-controls="collapseExample">
                Ferramentas
            </a>
            <div class="collapse" id="collapseFerramentas">
                <div class="card card-body text-black" style="text-align: justify">
                    {{ $project->ferramentas }}
                </div>
            </div>
        </li>
        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapsetags" role="button" aria-expanded="false" aria-controls="collapseExample">
                Tags
            </a>
            <div class="collapse" id="collapsetags">
                <div class="card card-body text-black" style="text-align: justify">
                    tags
                </div>
            </div>
        </li>
        @if(auth()->id() == $project->user_id)
            @if($project->arquivo != null)
                <li>
                    <a class="nav-link text-white" href="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->arquivo)}}" download="FileProject">Arquivo do projeto</a>
                </li>
            @endif
                <button style="width: 100%; margin-top: 5px; border-color: white; color: white" type="button"  class="btn btn-outline"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasComments" >Comentários </button>
                <button  style="width: 100%; margin-top: 5px; border-color: white; color: white" type="button" id = "edt-btn"  class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editProjectModal">
                    Editar
                </button>

            <form  id="deleteForm" method="post" action="{{ route('project.delete', $project->id) }}" >
                @csrf
                @method('DELETE')
                <button style="width: 100%; margin-top: 5px; border-color: white; color: white" type="button" id="remove-color" class="btn btn-outline-danger" onclick="confirmDeletion()">Excluir</button>
            </form>
        @else
            @if($project->arquivo != null && $project->arquivo_publico)
                <a class="nav-link text-white" href="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->arquivo)}}" download="FileProject">Arquivo do projeto</a>
            @endif
                <button style="width: 100%; margin-top: 5px; border-color: white; color: white" type="button"  class="btn btn-outline"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasComments" >Comentários </button>
        @endif



    </ul>
    <hr>
    <div class="dropdown">
        <a href="{{ route('user.perfil', $project->user->apelido) }}" class="d-flex align-items-center text-white text-decoration-none " >
            @if($project->user->foto != null)
                <img  alt="" width="32" height="32" class="rounded-circle me-2" src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->user->foto)}}">
            @else
                <img  alt="" width="32" height="32" class="rounded-circle me-2" src="/img/profile-img.png" alt="profile pic" />
            @endif
            <strong>{{ $project->user->apelido }}</strong>
        </a>
    </div>
</div>
