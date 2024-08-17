
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>
    <link href="/img/logo.png" rel ="icon">
    <link href="/css/perfil.css" rel ="stylesheet">
    <link href="/css/navbar.css" rel ="stylesheet">
    <link href="/css/login.css" rel ="stylesheet">

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
                @if(auth()->check())
                    <img class="profile-ima" src="{{ asset('storage/fotos/' . auth()->user()->foto) }}" alt="profile pic" />
                @else
                    <img class="profile-ima" src="/img/profile-img.png" alt="profile pic" />
                @endif
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
    @stack('styles')
    <div>

        @yield('content')

    </div>
    @stack('styles')

</html>

