

<div class="container" id="main">

    <div class="sing-up">
        <form class="forms" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
            <h1>Registrar</h1>
            @csrf
            <input  type="text" placeholder="nome" name="nome" value="{{ old('nome') }}">
            @error('nome')
            <span class="error-message">{{ $message }}</span>

            @enderror
            <input  type="text" placeholder="apelido" name="apelido" value="{{ old('apelido') }}" >
            @error('apelido')
            <span class="error-message">
                    {{ $message }}
                </span>

            @enderror
            <input  type="text" placeholder="número de telefone" name="numero_telefone" value="{{ old('numero_telefone') }}">
            @error('numero_telefone')
            <span class="error-message">{{ $message }}</span>

            @enderror
            <input  type="text" placeholder="email" name="email" value="{{ old('email') }}">
            @error('email')
            <span class="error-message">{{ $message }}</span>

            @enderror
            <input  type="password" placeholder="senha" name="password">

            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror

            @error('error')
            <span class="error-message">{{ $message }}</span>

            @enderror
            <input   type="password" placeholder="confirme a senha" name="password_confirmation">
            <label  for="file-upload">Foto de Perfil</label>
            <input id ="file-upload" type="file" placeholder="Foto de Perfil" name="foto" />

            @error('imagem')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <button  class="mainshadowdown" type="submit">Cadastrar</button>
            <p class="message">Já possui conta?  <a href="{{ route('auth.loginForm') }}">Faça login</a></p>
        </form>
    </div>
    <div class="sing-in">
        <form class="forms" action="{{ route('auth.login') }}" method="post">
        <h1 class="title"> Login </h1>
        @csrf
        <input  type="text"  placeholder="Email" name="email">

        @error('email')
        <span class="error-message">{{ $message }}
        </span>
        @enderror
        <input  type="password" placeholder="Senha" name="password">

        @error('password')
        <span class="error-message">{{ $message }}</span>
        @enderror
        @error('error')
        <span class="error-message">{{ $message }}</span>
        @enderror
        <button class="mainshadowdown" type="submit">Login</button>
        <p class="message">Não possui uma conta? <a href="{{ route('user.create') }}"> Cadastre-se</a></p>
        </form>
    </div>
    <div class="ove"></div>
</div>
