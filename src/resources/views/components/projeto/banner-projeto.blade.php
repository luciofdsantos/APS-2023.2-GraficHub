<header>
    <div class="header-container">
        <img class="img-fluid" src = "{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="Logo"  >
        <h2><strong></strong> </h2>
        <div class="voltar" ><a  href="{{ session('goBack') }}"> <--</a></div>
    </div>
</header>
