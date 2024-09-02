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
            <div id="favorite-wrapper" title="{{$project->id}}">
            @if(auth()->check() && auth()->user()->isFavoritado($project->id))
                <form id="form-desfavoritar" class="favorite-form" id="favoritarForm" name="{{$project->id}}">
                    <button class="favorite-btn" type="submit"><img  src="/img/marca-paginas-full.png"/></button>
                </form>
            @else
                <form id="form-favoritar" class="favorite-form" id="favoritarForm" name="{{$project->id}}">
                    <button class="favorite-btn" type="submit"><img  src="/img/marca-paginas.png"/></button>
                </form>
            @endif
                @if(auth()->check() && auth()->user()->isCurtido($project->id))
                    <form  id="liro" method="get" action="{{ route('project.descurtir', $project->id) }}" >
                        @csrf
                        <button type="submit">Deslike num: {{ $project->n_curtidas }}</button>
                    </form>
                @else
                    <form  id="liro" method="get" action="{{ route('project.curtir', $project->id) }}" >
                        @csrf
                        <button type="submit">Like num: {{ $project->n_curtidas }}</button>
                    </form>
                @endif
            </div>
        </div>

    </div>
</div>
