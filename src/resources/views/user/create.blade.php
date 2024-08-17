@extends('nonav')

@section('content')


    @if (session()->has('success'))
        {{ session()->get('sucess') }}
    @endif

    @if (auth()->check())
        Usuario logado, {{ auth()->user()->nome }} <a href="{{ route('auth.logout') }}"> Logout </a>
    @else

        <div class ="main">
        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
            <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
            <p class="title"> Cadastrar</p>
            @csrf
            <input class="mainshadowdown" type="text" placeholder="nome" name="nome" value="{{ old('nome') }}">
            @error('nome')
            <span class="error-message">
                {{ $message }}
            </span>
            @enderror
            <input class="mainshadowdown" type="text" placeholder="apelido" name="apelido" value="{{ old('apelido') }}" >
            @error('apelido')
            <span class="error-message">
                {{ $message }}
            </span>
            @enderror
            <input class="mainshadowdown" type="text" placeholder="número de telefone" name="numero_telefone" value="{{ old('numero_telefone') }}">
            @error('numero_telefone')
            <span class="error-message">
                {{ $message }}
            </span>
            @enderror
            <input class="mainshadowdown" type="text" placeholder="email" name="email" value="{{ old('email') }}">
            @error('email')
            <span class="error-message">
                {{ $message }}
            </span>
            @enderror
            <input class="mainshadowdown" type="password" placeholder="senha" name="password">
            @error('password')
            <span class="error-message">
                {{ $message }}
            </span>
            @enderror
            @error('error')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input  class="mainshadowdown" type="password" placeholder="confirme a senha" name="password_confirmation">
            <label class="mainshadowdown  custom-file-upload" for="file-upload">Foto de Perfil</label>
            <input id ="file-upload" type="file" placeholder="Foto de Perfil" name="foto" />
            @error('imagem')
            <span class="error-message">
                {{ $message }}
            </span>
            @enderror
            <button  class="mainshadowdown" type="submit">Cadastrar</button>
            <p class="message">Já possui conta?  <a href="{{ route('auth.loginForm') }}">Faça login</a></p>
        </form>
        </div>
    @endif
@endsection
