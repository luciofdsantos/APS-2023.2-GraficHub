<section>
    <div  class="container text-center">
        <div class="container">
                <div class="row row-cols-4">
                @foreach($projects as $project)
                        <a onclick="setOut()" href="{{ route('project.show', $project->id) }}">
                    <div class="cards" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url('{{ asset('storage/arquivos/' . $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}');">
                        <div class="card-category">{{ Str::limit(Str::title($project->titulo), 25) }}</div>
                        <div class="card-description ">
                            <h2> <i class="bi bi-heart-fill"></i> {{ str_pad($project->n_curtidas, 3, 0,STR_PAD_LEFT) }} <i class="bi bi-bookmark-fill"></i> {{ str_pad($project->n_favoritos, 3, 0,STR_PAD_LEFT) }}</h2>
                        </div>
                        @if($project->user['foto'] != null)
                            <img class="card-user avatar avatar-large" src="{{ asset('storage/arquivos/'. $project->user['id'] . '/' .$project->user['foto']) }}" alt="foto perfil">
                        @else
                            <img class="card-user avatar avatar-large" src="/img/profile-img.png" alt="profile pic" />
                        @endif
                    </div>
                            </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
