<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>

    <link href="/img/logo.png" rel ="icon">
    <link href="/css/navbar.css" rel ="stylesheet">
    <link href="/css/home.css" rel ="stylesheet">
    <link href="/css/dialog.css" rel ="stylesheet">
    <link href="/css/project.css" rel ="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">


</head>

<header class="nav-bar-wrapper mainshadowdown">
    <div class="logo-wrapper">
        <a href="{{ route('home') }}"> <img class="logo-img" src="/img/logo.png" alt="grafic hub logo"/> </a>
        <a href="{{ route('home') }}"> <img class="logo-text-img" src="/img/logo_text.png" alt="grafic hub logo"/> </a>
    </div>
    <div class="profile-wrapper">
        <img class="search-icon" src="/img/search-img.png" alt="search-icon" />
        <a href="{{ auth()->check() ? route('user.perfil', auth()->user()->apelido) : route('auth.loginForm') }}" class = "text">
            <div class="profile-pic-wrapper">
                <div class="profile-pic-wrapper">
                    @if(auth()->check() && auth()->user()->foto != null)
                        <img class="profile-pic" src="{{ asset('storage/arquivos/'. auth()->id() . '/' . auth()->user()->foto) }}" alt="profile pic" />
                    @else
                        <img class="profile-icon" src="/img/profile-img.png" alt="profile pic" />
                    @endif
                </div>
            </div>
            <div>
                @if(auth()->check())
                    {{ auth()->user()->apelido }}
                @else
                    Entrar/Cadastrar
                @endif
            </div>
        </a>
    </div>
</header>

<body class="mainhome" style="background-color: var(--GrayishWhite)">
<script src="/js/home.js"></script>
<div class="feed mainhome">
    <div class="box-options mainhome">
    <div class="box-intern">
            <div id ="descobrir-box" class="options"><a  id="descobrir"  href="{{ route('home') }}" onclick="discBGcolor()">Descobrir</a></div>
            <div id="seguindo-box" class="options" ><a   id="seguindo" href="{{ route('home.personalizado') }}" onclick="followBGcolor()">Seguindo</a></div>
    </div>
    </div>

<div class="project-box">
    @foreach($projects as $project)
        <div class=" mainshadowdown card">
            <img src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa)}}">
            <a href="{{ route('project.show', $project->id) }}" class="card__content">
                <p class="card__title "><heavy>{{ Str::limit(Str::title($project->titulo), 25) }}</heavy></p>
                <div class="block-with-text"><p class="card__description">{{ Str::limit(Str::title($project->descricao), 80) }}</p></div>
                <div class="card__description"><p>Curtidas 000 Salvos 000</p></div>
            </a>
        </div>
    @endforeach

</div>
    <div class="empt">{{ $projects->links() }}</div>
</div>
</body>

</html>
