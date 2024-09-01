<div class = "sideBar">
    <div class="user main-user">
        @if(auth()->id() != $project->user_id)
            <a class="user mainperfil" href="{{ route('user.perfil', $project->user->apelido) }}">
                @if($project->user->foto != null)
                    <img class="img-profile main-user" src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->user->foto)}}">
                @else
                    <img class="img-profile main-user" src="/img/profile-img.png" alt="profile pic" />
                @endif
                <div class="userInfo main-user">
                    <p class="name main-user">{{ $project->user->nome }} </p>
                    <p class="apelido main-user">{{ $project->user->apelido }}</p>
                </div>
            </a>
        @endif
    </div>
    <div class = "sideContent">



        <div class="descript">
            <h2><strong>Descrição:</strong></h2>
            <p> {{ $project->descricao }}</p>
        </div>
        <div class="descript">
            <p><strong>Ferramentas:</strong> {{ $project->ferramentas }}</p>
        </div>
        <div class="descript">
            <p><strong>Tags:</strong> </p>
        </div>


        @if(auth()->id() == $project->user_id)
            @if($project->arquivo != null)
                <a class="file-holder" href="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->arquivo)}}" download="FileProject"><img class="icon-pasta" src="/img/pasta-aberta.png" alt="pasta"></a>
            @endif
            <button onclick="openModal('box-edit-project')" id="btn-edit-project" class="edit-project" >Editar</button>

            <form  id="deleteForm" method="post" action="{{ route('project.delete', $project->id) }}" >
                @csrf
                @method('DELETE')
                <button type="button" class="delete" onclick="confirmDeletion()">Excluir</button>
            </form>
        @else
            @if($project->arquivo != null && $project->arquivo_publico)
                <a class="file-holder" href="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->arquivo)}}" download="FileProject"><img class="icon-pasta" src="/img/pasta-aberta.png" alt="pasta"></a>
            @endif
        @endif

    </div>
</div>
