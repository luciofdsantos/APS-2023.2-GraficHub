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
    <x-nav-bar :string="$string" />
    <section>
        <x-home.feed :projects="$projects"/>
    </section>
    <form style=" min-width: 500px; justify-content: end; margin-top: 70px; margin-right: 30px; " class=" d-flex gap-4" action="{{ route('home.busca') }}" method="GET">
        @csrf
        <input type="hidden" name="string" value="{{ $string }}">

        <div class="form-group d-flex gap-4">
            <div class="d-flex flex-column">
            <label style="width: 100px; " for="filtro">Filtrar por:</label>
            <select style="width: 180px; height: 40px" id="filtro " name="filtro" class="form-control ">
                <option value="n_curtidas">Curtidas</option>
                <option value="n_favoritos">Salvos</option>
                <option value="created_at">Data de Postagem</option>
            </select>
            </div>

            <div  class="d-flex flex-column ">
                <label   for="filtro">Ordem por:</label>
                <select style="width: 120px; height: 40px"  id="ordem" name="ordem" class="form-control">
                    <option value="asc">Crescente</option>
                    <option value="desc">Decrescente</option>
                </select>
            </div>
            <div class="d-flex align-items-end">
                <button id="search-btn" style="width: 100px; height: 40px; " type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>


    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>

</html>
