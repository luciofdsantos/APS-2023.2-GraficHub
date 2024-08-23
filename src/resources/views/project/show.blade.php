<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>
    <link href="/img/logo.png" rel ="icon">
    <link href="/css/projectfullview.css" rel ="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<header>
    <div class="header-container">

        <img class="img-fluid" src = "{{ asset('storage/arquivos/'. auth()->id() . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="Logo"  >
        <h2><strong>{{ Str::title($project->titulo) }}</strong> </h2>
        <p><strong> Curtidas 0000 Salvos 0000</strong> </p>
        <div class="voltar" ><a  href="{{ route('user.perfil', auth()->user()->apelido) }}"> <--</a></div>


    </div>
</header>

<body>
<div class="containerss">
    <div class = "sideBar">
    <div class = "sideContent">
        <div class="descript">
            <h2><strong>Descrição:</strong></h2>
            <p> {{ $project->descricao }}</p>
        </div>
        <div class="descript">
            <p><strong>Ferramentas:</strong> {{ $project->ferramentas }}</p>
        </div>
        <div class="descript">
            <p><strong>Tags:</strong> </p>
        </div>
        @if($project->arquivo != null)
            <a class="file-holder" href="{{ asset('storage/arquivos/'. auth()->id() . '/' . $project->id . '/' . $project->arquivo)}}" download="FileProject"><img class="icon-pasta" src="/img/pasta-aberta.png" alt="pasta"></a>
        @endif

        <form method="get" action="{{ route('project.edit', $project->id) }}">
            @csrf
            <button class="edit" >Editar</button>
        </form>
        <form id="deleteForm" method="post" action="{{ route('project.delete', $project->id) }}" >
            @csrf
            @method('DELETE')
            <button type="button" class="delete" onclick="confirmDeletion()">Excluir</button>
        </form>
    </div>
    </div>
    <div class="imagens">
        <div class="posts">
            @foreach($project->imagesProjects as $image)
                <div class="photo-holder">
                    <img src="{{ asset('storage/arquivos/'. auth()->id() . '/' . $project->id . '/' .'imgs'.'/'.$image->name)}}" alt="">
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/functions.js') }}"></script>
</body>

</html>


