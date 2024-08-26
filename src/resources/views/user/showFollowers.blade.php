
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
    <link href="/css/login.css" rel ="stylesheet">
    <link href="/css/dialog.css" rel ="stylesheet">
    <link href="/css/perfil.css" rel ="stylesheet">
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

<body>
<div class="main-content">
    <div class = "sideBar mainperfil">
        <div class = "user mainperfil">
            @if($user['foto'] != null)
                <img class="userImg mainperfil" src="{{ asset('storage/arquivos/'. $user['id'] . '/' . $user['foto']) }}">
            @else
                <img class="userImg mainperfil" src="/img/profile-img.png" alt="profile pic" />
            @endif
            <div class="userInfo mainperfil">
                <p class="name mainperfil">{{ $user['nome'] }} </p>
                <p class="apelido mainperfil">{{ $user['apelido']}}</p>
            </div>
        </div>

        <form action="{{ route('user.seguidores', $user['apelido']) }}" method="get">
            <div class = "userFollowers mainperfil mainshadowdown">
                <button type="submit"> Seguidores {{ $user->seguidores()->count() }}</button>
            </div>
        </form>

        <form action="{{ route('user.seguindo', $user['apelido']) }}" method="get">
            <div class = "userFollowers mainperfil mainshadowdown">
                <button type="submit"> Seguindo {{ $user->seguindo()->count() }}</button>
            </div>
        </form>

        @if(auth()->id() == $user['id'])
            <form action="{{route('user.updateDisp', $user['id'])}}" method="post">
                @csrf
                @if($user['disponivel'])
                    <button type="submit" class="disp-btn green-disp-btn">Disponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></button>
                @else
                    <button  type="submit" class="disp-btn red-disp-btn">Indisponível <img class="disp-info-icon" src="/img/info-icon.png"  onmouseover="showMessage()" onmouseout="hideMessage()"> </button>
                @endif
                <div id="disp-info-text">
                </div>
            </form>
        @endif



        <div class="mainperfil options">
        </div>
        @if(auth()->id() == $user['id'])
            <button id = "btn-edit-profile" class="edit mainshadowdown">Editar Perfil</button>
            <a class="logout mainshadowdown" onclick="confirmLogout(event)" href ="{{route('auth.logout')}}">LogOut</a>
        @else
            @if(!auth()->check() || !auth()->user()->isSeguindo($user['id']))
                <form id="follow" method="post" action="{{ route('user.follow', $user['id']) }}" >
                    @csrf
                    <button type="submit">Follow</button>
                </form>
            @else
                <form id="unfollow" method="post" action="{{ route('user.unfollow', $user['id']) }}" >
                    @csrf
                    <button type="submit">Unfollow</button>
                </form>
            @endif
        @endif

    </div>
    <div class="portifolio mainperfil mainshadowdown">
        <div class="project-box">
            @foreach($followers as $follower)
                <div style="margin-bottom: 10px;">
                    <p>{{ $follower->apelido }}</p>
                    @if(auth()->id() != $follower->id)
                        @if(!auth()->check() || !auth()->user()->isSeguindo($follower->id))
                            <form action="{{ route('user.follow', $follower->id) }}" method="post">
                                @csrf
                                <button type="submit">Follow</button>
                            </form>
                        @else
                            <form action="{{ route('user.unfollow', $follower->id) }}" method="post">
                                @csrf
                                <button type="submit">Unfollow</button>
                            </form>
                        @endif
                    @endif
                </div>
            @endforeach
            {{ $followers->links() }}
        </div>
    </div>
    <script src="/js/functions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
    <script src="/js/seguidores.js"></script>
</div>

<dialog id = "box-edit-profile">
    <div class="user-form-container">
        <div class="main">
            <form class="forms" action="{{ route('user.update', $user['apelido']) }}" method="post" enctype="multipart/form-data">
                <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
                <p class="title"> Atualizar Dados</p>
                @csrf
                @method('PUT')
                <input class="mainshadowdown" type="text" placeholder="nome" name="nome"
                       value="{{ old('nome', $user['nome']) }}">
                @error('nome')
                <span class="error-message">
                    {{ $message }}
                </span>
                @enderror
                <input class="mainshadowdown" type="text" placeholder="apelido" name="apelido"
                       value="{{ old('apelido', $user['apelido']) }}">
                @error('apelido')
                <span class="error-message">
                    {{ $message }}
                </span>
                @enderror
                <input class="mainshadowdown" type="text" placeholder="número de telefone" name="numero_telefone"
                       value="{{ old('numero_telefone', $user['numero_telefone']) }}">
                @error('numero_telefone')
                <span class="error-message">
                    {{ $message }}
                </span>
                @enderror
                <input class="mainshadowdown" type="text" placeholder="email" name="email"
                       value="{{ old('email', $user['email']) }}">
                @error('email')
                <span class="error-message">
                    {{ $message }}
                </span>
                @enderror
                <input class="mainshadowdown" type="password" placeholder="Nova senha" name="password">
                @error('password')
                <span class="error-message">
                    {{ $message }}
                </span>
                @enderror
                <input class="mainshadowdown" type="password" placeholder="confirme a nova senha" name="password_confirmation">
                <label class="mainshadowdown custom-file-upload" for="file-upload">Foto de Perfil</label>
                <input id="file-upload" type="file" name="foto" placeholder="Foto de Perfil">
                @error('foto')
                <span class="error-message">
                    {{ $message }}
                </span>
                @enderror
                <button class="mainshadowdown" type="submit">Atualizar</button>
                <p class="message"><a href="{{ route('user.perfil', $user['apelido']) }}">Voltar para o Perfil</a></p>
            </form>
        </div>
    </div>
</dialog>
</body>

</html>



