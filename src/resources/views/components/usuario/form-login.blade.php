<div class="login-form-container">
    <div class="main">
        <form class="forms" action="{{ route('auth.login') }}" method="post">
            <a href="{{ route('home')}}"> <img class="logo-img" alt="logo" src="/img/logo.png"/> </a>
            <p class="title"> Login </p>
            @csrf
            <input class="mainshadowdown" type="text"  placeholder="Email" name="email">
            @error('email')
            <span class="error-message">
                       {{ $message }}
                        </span>
            @enderror
            <input class="mainshadowdown" type="password" placeholder="Senha" name="password">
            @error('password')
            <span class="error-message">
                        {{ $message }}
                        </span>
            @enderror
            @error('error')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <button class="mainshadowdown" type="submit">Login</button>
            <p class="message">Não possui uma conta? <a href="{{ route('user.create') }}"> Cadastre-se</a></p>

        </form>
    </div>
</div>
