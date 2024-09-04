<div class="project-box">
    @foreach($projects as $project)

        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ Str::limit(Str::title($project->titulo), 25) }}</h5>
                <p class="card-text">{{ Str::limit(Str::title($project->descricao), 80) }}</p>
                <p>Curtidas {{ str_pad($project->n_curtidas, 3, 0,STR_PAD_LEFT) }} Salvos {{ str_pad($project->n_favoritos, 3, 0,STR_PAD_LEFT) }}</p>
                <a onclick="setOut()" href="{{ route('project.show', $project->id) }}" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    @endforeach
</div>
