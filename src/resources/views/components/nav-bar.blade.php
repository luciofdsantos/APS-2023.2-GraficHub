<!--<header class="nav-bar-wrapper mainshadowdown">
    <div class="logo-wrapper">
        <a onclick="setOut()" href="{{ route('home') }}"> <img class="logo-img" src="/img/logo.png" alt="grafic hub logo"/> </a>
        <a onclick="setOut()" href="{{ route('home') }}"> <img class="logo-text-img" src="/img/logo_text.png" alt="grafic hub logo"/> </a>
    </div>
    <div class="profile-wrapper">
        <img class="search-icon" src="/img/search-img.png" alt="search-icon" />
        <a onclick="setOut()" href="{{ auth()->check() ? route('user.perfil', auth()->user()->apelido) : route('auth.loginForm') }}" class = "profile-wrapper-text">
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

-->

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand me-auto" href="{{ route('home') }}"> <img style="width: 35px;" src="/img/grafichub.png" alt=""></a>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

            <div class="offcanvas-header">
                <img style="width: 35px;" src="/img/grafichub.png"> <h5 class="offcanvas-title" id="offcanvasNavbarLabel"> GraficHub</h5>
                <button id="btn-closs"type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center ">

                    <li  class="nav-item">
                        <a id="homeSelect" class="nav-link mx-lg-4 active" aria-current="page" href="{{ route('home')}}"> Home </a>
                    </li>

                    <li  class= "nav-item">
                        <div class="d-flex justify-content-center h-10">
                            <form action="{{ route('home.busca') }}" method="GET" class="searchbar">
                                <input type="hidden" name="filtro" value="created_at">
                                <input type="hidden" name="ordem" value="desc">
                                <input id="search" class="search_input" type="text" name="string" placeholder="Digite a busca" value="{{ isset($string) ? $string:null }}">
                                <button id="searchSelect" type="submit" class="search_icon nav-link mx-lg-2" onclick="setSearch()">Pesquisar</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
        @if(auth()->check())
            <a href="{{ route('user.perfil', auth()->user()->apelido)  }}">
            <div class="profile-button">
                @if(auth()->check() && auth()->user()->foto != null)
                    <img style="height: 26px; width: 24px" class="img-comment" src="{{ asset('storage/arquivos/'. auth()->id() . '/' . auth()->user()->foto) }}" alt="profile pic" />
                @else
                    <img style="height: 26px; width: 24px"  class="img-comment" src="/img/profile-img.png" alt="profile pic" />
               @endif
                    <a  href="{{ route('user.perfil', auth()->user()->apelido)  }}">{{ auth()->user()->apelido }}</a>
            </div>
            </a>
        @else
            <a class="login-button" href="{{route('auth.loginForm')}}">Login</a>
        @endif
        <button id="nav-toggler" class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
