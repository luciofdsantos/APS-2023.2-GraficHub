<header>
    <div class="header-container">
        <img class="img-fluid" src = "{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="Logo"  >
        <h2><strong>{{ Str::title($project->titulo) }}</strong> </h2>
        <p><strong> Curtidas {{ str_pad($project->n_curtidas, 4, 0,STR_PAD_LEFT) }} Salvos {{ str_pad($project->n_favoritos, 4, 0,STR_PAD_LEFT) }}</strong> </p>
        <div class="voltar" ><a  href="{{ session('goBack') }}"> <--</a></div>
    </div>
</header>
