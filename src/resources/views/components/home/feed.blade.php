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
        <div style=" width: 50vh; min-width: 625px;" class="border info-feed-top container ">
            <div class="container d-flex align-items-center ">
                <div class="row g-0">
                    <a href="{{ route('user.perfil', $project->user->apelido) }}"  class=" d-flex col-4 col-md-2 align-items-center gap-2 ">
                        <div style="width: 40px; height: 40px">
                            @if($project->user['foto'] != null)
                                <img class="card-user-feed avatar avatar-large" src="{{ asset('storage/arquivos/'. $project->user['id'] . '/' .$project->user['foto']) }}" alt="foto perfil">
                            @else
                                <img class="card-user-feed avatar avatar-large" src="/img/profile-img.png" alt="profile pic" />
                           @endif
                        </div >
                        <div class="name align-items-center">
                            <p style="font-size: 16px; font-weight: 600; padding-top: 12px; padding-left: 6px;color: black">{{$project->user->apelido}}</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <div  style="width: 50vh;height: 62.5vh;" class=" d-flex  carousel-inner">
            <div class="border carousel-item  active">
                <img src="{{ asset('storage/arquivos/' . $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}" class="d-block  img-feed" alt="...">
            </div>
            @foreach($project->imagesProjects()->get() as $image)
                <div class=" border carousel-item">
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
        <div style=" width: 50vh; min-width: 625px;" class="border info-feed-bot container mb-4 p-10">
            <div class="row">
                <strong> <a href="{{ route('project.show', $project->id) }}" style="color: black; text-decoration:none;font-size: 20px">{{$project->titulo}}</a></strong>
            </div>
            <div class="row ">
                <div class="d-flex gap-2 option-feed">
                    @if(auth()->check())
                        <a style="text-decoration: none" href="#" onclick="likeHandlerFeed(this)" title="{{$project->id}}"><i style="background-color: transparent" id="like-icon-{{$project->id}}" class="like-icon bi bi-heart text-danger" title="{{$project->id}}" ></i></a><div id="likes-number-{{$project->id}}" title="0" >0</div>
                        <a style="text-decoration: none" href="#" onclick="favoriteHandlerFeed(this)" title="{{$project->id}}"><i style="background-color: transparent" id="favorite-icon-{{$project->id}}" class="fav-icon bi bi-bookmark text-warning" title="{{$project->id}}"></i></a><div id="favorites-number-{{$project->id}}" title="0" >0</div>
                    @else
                        <a style="text-decoration: none" href="{{route('project.curtir', $project->id)}}"><i style="background-color: transparent" id="like-icon" class="bi bi-heart  text-danger"></i></a>
                        <a style="text-decoration: none" href="{{route('project.favoritar', $project->id)}}"><i style="background-color: transparent" id="favorite-icon" class="bi bi-bookmark text-warning"></i></a>
                    @endif
                </div>
            </div>
            <div class="row">
                <p style="font-size: 14px; text-align: justify">{{$project->descricao}}</p>
            </div>
        </div>

    </div>
    @endforeach
</section>



