
<div class="project-box">
    @foreach($projects as $project)
        <ul class="card-list">
        <li class="card">
            <a class="card-image" href="https://michellezauner.bandcamp.com/album/psychopomp-2" target="_blank" style="background-image: url("{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa)}}");" data-image-full="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa)}}">
                <img src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa)}}" alt="Psychopomp" />
            </a>
            <a class="card-description" href="https://michellezauner.bandcamp.com/album/psychopomp-2" target="_blank">
                <h2>Psychopomp</h2>
                <p>Japanese Breakfast</p>
            </a>
        </li>
        </ul>
    @endforeach
</div>
<div class="card" style="width: 18rem;">
    <img  class="card-img-top img-fluid" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{ Str::limit(Str::title($project->titulo), 25) }}</h5>
        <p class="card-text">{{ Str::limit(Str::title($project->descricao), 80) }}</p>
        <p>Curtidas {{ str_pad($project->n_curtidas, 3, 0,STR_PAD_LEFT) }} Salvos {{ str_pad($project->n_favoritos, 3, 0,STR_PAD_LEFT) }}</p>
        <a onclick="setOut()" href="{{ route('project.show', $project->id) }}" class="btn btn-primary">Go somewhere</a>
    </div>
</div>

