<div class="project-box">
    @foreach($projects as $project)
        <div class=" mainshadowdown card">
            <img src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa)}}">
            <a onclick="setOut()" href="{{ route('project.show', $project->id) }}" class="card__content">
                <p class="card__title "><heavy>{{ Str::limit(Str::title($project->titulo), 25) }}</heavy></p>
                <div class="block-with-text"><p class="card__description">{{ Str::limit(Str::title($project->descricao), 80) }}</p></div>
                <div class="card__description"><p>Curtidas 000 Salvos 000</p></div>
            </a>
        </div>
    @endforeach
</div>
