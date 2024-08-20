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

</head>
<header>
    <div class="header-container">
        <img class="img-fluid" src = "{{ asset('storage/arquivos/'. auth()->id() . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="Logo"  >
        <h2><strong>{{ $project->titulo }}</strong> </h2>
    </div>
</header>

<body>
<div class="containerss">
    <div class = "sideBar">
    <div class = "sideContent">
        <div class="descript">
            <h2><strong>Descricao:</strong></h2>
            <p> {{ $project->descricao }}</p>
        </div>
        <div class="descript">
            <p><strong>Ferramentas:</strong> {{ $project->ferramentas }}</p>
        </div>
        <div class="descript">
            <a href="{{ asset('storage/arquivos/'. auth()->id() . '/' . $project->id . '/' . $project->arquivo)}}" download="FileProject"> Arquivo do Projeto</a>

        </div>

        <form method="get" action="{{ route('project.edit', $project->id) }}">
            @csrf
            <button class="edit" >Editar</button>
        </form>
        <form method="post" action="{{ route('project.delete', $project->id) }}">
            @csrf
            @method('DELETE')
            <button class="delete">Excluir</button>
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
</body>

</html>


