<section>
    <div  class="container text-center">
        <div class="container">
                <div class="row row-cols-4">
                @foreach($projects as $project)
                        <a onclick="setOut()" href="{{ route('project.show', $project->id) }}">
                    <div class="cards" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url('{{ asset('storage/arquivos/' . $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}');">
                        <div class="card-category">{{ Str::limit(Str::title($project->titulo), 25) }}</div>
                        <div class="card-description ">
                            <h2 class="d-flex"> <i class="bi bi-heart-fill"></i> <div style="margin: 0 4px 0 8px" class="text-white project-likes-number" title="{{$project->n_curtidas}}">0</div> <i class="bi bi-bookmark-fill"></i> <div style="margin: 0 4px 0 8px" class="text-white project-favorites-number" title="{{$project->n_favoritos}}">0</div></h2>
                        </div>
                        <div style="height: 40px; width: 40px">
                        @if($project->user['foto'] != null)
                            <img class="card-user avatar avatar-large" src="{{ asset('storage/arquivos/'. $project->user['id'] . '/' .$project->user['foto']) }}" alt="foto perfil">
                        @else
                            <img class="card-user avatar avatar-large" src="/img/profile-img.png" alt="profile pic" />
                        @endif
                        </div>
                    </div>
                            </a>
                @endforeach
            </div>

        </div>

    </div>
    <div class="d-flex  justify-content-center">
        <div class="custom-pagination "> {{ $projects->links() }} </div>
    </div>
</section>

