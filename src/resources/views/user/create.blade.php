@extends('nonav')

@section('content')

    <a href="{{ route('home') }}"> Home </a>

    <h2> Cadastrar </h2>

    @if (session()->has('success'))
        {{ session()->get('sucess') }}
    @endif

    @if (auth()->check())
        Usuario logado, {{ auth()->user()->nome }} <a href="{{ route('auth.logout') }}"> Logout </a>
    @else

        @error('error')
        <span>{{ $message }}</span>
        @enderror

        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <input type="text" placeholder="nome" name="nome">
            @error('nome')
            <span>
                {{ $message }}
            </span>
            @enderror
            <input type="text" placeholder="apelido" name="apelido">
            @error('apelido')
            <span>
                {{ $message }}
            </span>
            @enderror
            <input type="text" placeholder="número de telefone" name="numero_telefone">
            @error('numero_telefone')
            <span>
                {{ $message }}
            </span>
            @enderror
            <input type="text" placeholder="email" name="email">
            @error('email')
            <span>
                {{ $message }}
            </span>
            @enderror
            <input type="password" placeholder="senha" name="password">
            @error('password')
            <span>
                {{ $message }}
            </span>
            @enderror
            <input type="password" placeholder="confirme a senha" name="password_confirmation">
            <button type="submit">Cadastrar</button>
        </form>
    @endif
@endsection
