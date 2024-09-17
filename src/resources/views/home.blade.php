<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>

    <link href="/img/logo.png" rel ="icon">
    <link href="/css/index.css" rel ="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body onload="getPage()" class="mainhome" style="background: var(--GrayishWhite)">
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
    <script src="/js/home.js"></script>
    <script src="/js/functions.js"></script>
    <x-nav-bar/>
    <section class="hero-section">
        <div class="container d-flex  justify-content-center fs-1 text-white flex-column">
            <h1>Compartilhe seus Projetos com</h1>
            <h1>o Mundo.</h1>
        </div>
    </section>
    <section>
        <div class="d-flex justify-content-center align-items-center pt-3 ">
            <div class="btn-group pb-3">
                <a id="descobrir"  href="{{ route('home') }}" class="btn btn-primary" aria-current="page"  onclick="discBGcolor()"> <i class="bi bi-globe"></i> Descobrir </a>
                <a id="postseguidos" href="{{ route('home.personalizado') }}"  class="btn btn-primary"  @if(auth()->check())onclick="followBGcolor()" @else  onclick="setOut()" @endif> <i class="bi bi-box"></i> Seguindo </a>
            </div>
        </div>
        <x-home.feed :projects="$projects"/>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>

</html>
