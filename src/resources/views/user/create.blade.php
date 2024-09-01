<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>
    <link href="/img/logo.png" rel ="icon">
    <link href="/css/login.css" rel ="stylesheet">
</head>
<body>
    @if (session()->has('success'))
        {{ session()->get('sucess') }}
    @endif

    @if (auth()->check())
        Usuario logado, {{ auth()->user()->nome }} <a href="{{ route('auth.logout') }}"> Logout </a>
    @else
        <x-form-cadastro />
    @endif

</body>

</html>
