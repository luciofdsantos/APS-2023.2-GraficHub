<header>
    <div class="header-container">
        <img class="img-fluid" src = "{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="Logo"  >
        <h2><strong>{{ Str::title($project->titulo) }}</strong> </h2>
        <p><strong> Curtidas 0000 Salvos 0000</strong> </p>
        @if(auth()->id() == $project->user_id)
            <div class="voltar" ><a  href="{{ route('user.perfil', auth()->user()->apelido) }}"> <--</a></div>
        @else
            <div class="voltar" ><a  href="{{ url()->previous() }}"> <--</a></div>
        @endif
    </div>
</header>
