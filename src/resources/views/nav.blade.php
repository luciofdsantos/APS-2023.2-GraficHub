
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/css/navbar.css" rel ="stylesheet">
    <link href="/css/login.css" rel ="stylesheet">

</head>
<body>
<header class="nav-bar-wrapper mainshadowdown">
    <div class="logo-wrapper">
        <a href="{{ route('home') }}"> <img class="logo-img" src="/img/logo.png" alt="grafic hub logo"/> </a>
       <a href="{{ route('home') }}"> <img class="logo-text-img" src="/img/logo_text.png" alt="grafic hub logo"/> </a>
    </div>
    <div class="picture-wrapper">
        <a href="{{ route('auth.loginForm') }}" class = "text"><img class="profile-ima" src="/img/profile-img.png" alt="profile pic" /> <div>Entrar/Cadastrar</div></a>
    </div>
</header>
    @stack('styles')
    <div>


        @yield('content')

    </div>
    @stack('styles')
</body>

</html>

