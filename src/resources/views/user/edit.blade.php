@extends('nonav')

@section('content')

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

@endsection
