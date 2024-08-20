
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
    <link href="/css/perfil.css" rel ="stylesheet">
    <link href="/css/project.css" rel ="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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

    <body>
    <div class="main-content">
    <div class = "sideBar main">
        <div class = "user main">
            @if(auth()->user()->foto != null)
                <img class="userImg main" src="{{ asset('storage/arquivos/'. auth()->id() . '/' . auth()->user()->foto)}}">
            @else
                <img class="userImg main" src="/img/profile-img.png" alt="profile pic" />
            @endif
            <div class="userInfo main">
                <p class="name main">{{ $user['nome'] }} </p>
                <p class="apelido main">{{ $user['apelido']}}</p>
            </div>
        </div>

        <div class = "userFollowers main mainshadowdown">
            <p class = "tag"> Seguidores </p>  <p class="count"> 0000</p>
        </div>
        <div class = "userFollowers main mainshadowdown">
            <p class = "tag"> Seguindo</p>  <p class="count"> 0000</p>
        </div>

        <form action="{{route('user.updateDisp', $user['id'])}}" method="post">
            @csrf
            @if($user['disponivel'])
                <button type="submit" class="disp-btn green-disp-btn">Disponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></button>
            @else
                <button type="submit" class="disp-btn red-disp-btn">Indisponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></button>
            @endif
            <div id="disp-info-text">

            </div>
        </form>
        <div class="contact">
            <div class="button-container main">
                <a href="mailto:{{ $user['email'] }}" class="round-button main"> <img class="logophoto" src="/img/email.png" alt="mail logo"></a>
                <a href="https://wa.me/{{ $user['numero_telefone'] }}" class="round-button main">  <img class="logophoto" src="/img/wpp.png" alt="wpp logo"> </a>
            </div>
        </div>





        <div class="main options">
        </div>

        <a class="edit mainshadowdown" href="{{ route('user.edit', $user['apelido']) }}" >Editar Perfil</a>
        <a class="logout mainshadowdown" href ="{{route('auth.logout')}}">LogOut</a>
    </div>
    <div class="portifolio main mainshadowdown">
            <a class="mainshadowdown portBox" href="{{route('project.create')}}">+</a>
            <div class="project-box">
                @foreach($projects as $project)

                    <div class=" mainshadowdown card">
                        <img src="{{ asset('storage/arquivos/'. auth()->id() . '/' . $project->id . '/' . $project->imagem_capa)}}">
                        <div class="card__content">
                            <a href="{{ route('project.show', $project->id) }}" class="card__title "> <heavy>{{$project->titulo}}</heavy> </a>
                            <div class="block-with-text"> <p class="card__description">{{$project->descricao}}</p></div>
                            <div class="card__description"> <p>Curtidas 000  Salvos 000</p></div>
                           </div>
                    </div>
                @endforeach
            </div>
        <div class="empt"> {{ $projects->links() }} </div>
    </div>
    <script src="/js/functions.js"></script>
    </div>
    </body>

</html>



