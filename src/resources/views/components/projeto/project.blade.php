<div class="project-main-content">


    <x-projeto.side-bar-projeto :project="$project"/>

    <div class="project-images">
        <div class="carousel-container">
            <div class="carousel">
                <div class="item active">
                    <img src = "{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="">
                    <p class="caption">Imagem de Capa</p>
                </div>
                @foreach($images as $image)
                    <div class="item">
                        <img src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' .'imgs'.'/'.$image->name)}}" alt="">
                    </div>
                @endforeach
            </div>
            <button class="btn prev"><</button>
            <button class="btn next"> ></button>
            <div class="dots"></div>
            @if(auth()->check() && auth()->user()->isFavoritado($project->id))
                <form class="favorite-form" id="favoritarForm" method="get" action="{{ route('project.desfavoritar', $project->id) }}" >
                    @csrf
                    <button class="favorite-btn" type="submit"><img  src="/img/marca-paginas-full.png"/></button>
                </form>
            @else
                <form class="favorite-form" id="favoritarForm" method="get" action="{{ route('project.favoritar', $project->id) }}" >
                    @csrf
                    <button class="favorite-btn" type="submit"><img  src="/img/marca-paginas.png"/></button>
                </form>
            @endif
        </div>

    </div>
</div>
