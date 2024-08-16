
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/css/navbar.css" rel ="stylesheet">
    <link href="/css/perfil.css" rel ="stylesheet">

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
                <img class="profile-ima" src="/img/profile-img.png" alt="profile pic" />
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
    <div class = "sideBar main">
        <div class = "user main">
            <img class="userImg main" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRF1IwK6-SxM83UpFVY6WtUZxXx-phss_gAUfdKbkTfau6VWVkt">
            <div class="userInfo main">
                <p class="name main">{{ $user['nome'] }} </p>
                <p class="apelido main">{{ $user['apelido']}}</p>
            </div>
        </div>

        <div class = "userFollowers main mainshadowdown">
            <p class = "tag"> Seguidores </p>  <p class="count"> 0000</p>
        </div>
{{--            <div class="circulo">--}}
{{--            </div>--}}
{{--            <p>Indisponível</p>--}}
        <form action="{{route('user.updateDisp', $user['id'])}}" method="post">
            @csrf
            @if($user['disponivel'])
                <button type="submit" class="disp-btn green-disp-btn">Disponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></img></button>
            @else
                <button type="submit" class="disp-btn red-disp-btn">Indisponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></button>
            @endif
            <div id="disp-info-text">

            </div>
        </form>
        <div class="main contact">
            <p class="title">Contato</p>
        </div>

        <div class="contactBox mail mainshadowdown"> <p>{{ $user['email'] }} </p></div>
        <div class="contactBox fone mainshadowdown"> <p>{{ $user['numero_telefone'] }}</p></div>

        <div class="main options">
        </div>

        <div class="editBox mainshadowdown"><a class="edit" href="{{ route('user.edit', $user['apelido']) }}" >Editar Perfil</a></div>
        <div class="logoutBox mainshadowdown"><a class="logout" >LogOut</a></div>
    </div>
    <div class="portifolio main mainshadowdown">
            <div class="portBox"> <a>Criar Projeto</a></div>
            <div class="portBox"> <a>Gerir Projetos</a></div>
    </div>
    <script src="/js/functions.js"></script>
    </body>

</html>



