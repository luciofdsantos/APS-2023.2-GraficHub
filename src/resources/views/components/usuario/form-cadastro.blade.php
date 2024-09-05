<section>
    <section>

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <!----------------------- Login Container -------------------------->
            <div class="row border rounded-5 p-3 bg-white shadow box-area">
                <!--------------------------- Left Box ----------------------------->
                <div style="background-color: #2e2e2e" class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                    <div class="featured-image mb-3">
                        <img  src="/img/profile-img.png" class="img-fluid" style="width: 250px; ">
                    </div>
                </div>
                <!-------------------- ------ Right Box ---------------------------->

                <div class="col-md-6 right-box">

                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h2>Seja bem-vindo</h2>
                            <p>Estamos felizes em te receber.</p>
                        </div>
                        <form class="forms" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg bg-light fs-6" type="text" placeholder="nome" name="nome" value="{{ old('nome') }}">
                            </div>
                             @error('nome')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                            <div class="input-group mb-1">
                                <input  class="form-control form-control-lg bg-light fs-6" type="text" placeholder="apelido" name="apelido" value="{{ old('apelido') }}" >
                            </div>
                             @error('apelido')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                            <div class="input-group mb-1">
                                <input  class="form-control form-control-lg bg-light fs-6" type="text" placeholder="número de telefone" name="numero_telefone" value="{{ old('numero_telefone') }}">
                            </div>
                             @error('numero_telefone')
                            <span class="error-message">
                    {{ $message }}
                </span>
                            @enderror
                            <div class="input-group mb-1">
                                <input  class="form-control form-control-lg bg-light fs-6" type="text" placeholder="email" name="email" value="{{ old('email') }}">
                            </div>
                             @error('email')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg bg-light fs-6" type="password" placeholder="senha" name="password">
                            </div>
                             @error('password')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                            @error('error')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg bg-light fs-6" type="password" placeholder="confirme a senha" name="password_confirmation">
                            </div>
                            <div  class="label-group mb-1">
                                <label style="cursor:pointer;" class="form-control form-control-lg bg-light fs-6" for="file-upload">Foto de Perfil</label>
                                <input style="visibility: hidden" id ="file-upload" type="file" placeholder="Foto de Perfil" name="foto" />
                            </div>
                            @error('imagem')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                            <button style="background-color:#2e2e2e;border: none;" class="btn btn-lg btn-primary w-100 fs-6" type="submit">Cadastrar</button>
                            <p class="message">Já possui conta?  <a style="text-decoration: none;color: #656565" href="{{ route('auth.loginForm') }}">Faça login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>
