<!--<div class="feed mainhome">
    <div class="box-options mainhome">
        <div class="box-intern">
            <div id ="descobrir-box" class="options"><a  id="descobrir"  >Descobrir</a></div>

            <div id="seguindo-box" class="options" ><a   id="seguindo">Seguindo</a></div>
        </div>
    </div>
        <x-projeto.grid-projetos :projects="$projects"/>
        <div class="empt">{{ $projects->links() }}</div>

</div>
-->
<div class="d-flex justify-content-center align-items-center pt-3 ">
    <div class="btn-group pb-3">
        <a  href="{{ route('home') }}" class="btn btn-primary active" aria-current="page"  onclick="discBGcolor()"> <i class="bi bi-globe"></i> Descobrir </a>
        <a href="{{ route('home.personalizado') }}"  class="btn btn-primary"  @if(auth()->check())onclick="followBGcolor()" @else  onclick="setOut()" @endif> <i class="bi bi-box"></i> Seguindo </a>
    </div>
</div>
<section class="container">
    @foreach($projects as $project)
    <div id="carouselExample{{$project->id}}" class="carousel slide d-flex flex-column justify-content-center align-items-center">
        <div style="width: 50vh" class="info-feed container ">
            <div class="row">

                    foto
                    nome
            </div>
        </div>
        <div  style="width: 50vh;height: 62.5vh;" class=" d-flex border carousel-inner">
            <div class=" carousel-item  active">
                <img src="{{ asset('storage/arquivos/' . $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}" class="d-block  img-feed" alt="...">
            </div>
            @foreach($project->imagesProjects()->get() as $image)

                <div class=" carousel-item">
                    <img class="img-feed d-block  img-feed" src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' .'imgs'.'/'.$image->name)}}" alt="">
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{$project->id}}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{$project->id}}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            @endforeach
        </div>
        <div style="width: 50vh" class="info-feed container ">
            <div class="row">
                titulo
            </div>
            <div class="row">
                curtir favoritar
            </div>
            <div class="row">
                descrição
            </div>
        </div>

    </div>
    @endforeach
</section>



