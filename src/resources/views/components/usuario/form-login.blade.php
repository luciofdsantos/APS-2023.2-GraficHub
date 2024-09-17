<section>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Login Container -------------------------->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!--------------------------- Left Box ----------------------------->
            <div style="background-color: #2e2e2e" class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img  src="img/profile-img.png" class="img-fluid" style="width: 250px; ">
                </div>
            </div>
            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">

                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Olá</h2>
                        <p>Estamos felizes em te ver de novo.</p>
                    </div>
                    <form class="forms" action="{{ route('auth.login') }}" method="post">

                        @csrf
                        <div class="input-group mb-3">
                            <input class="form-control form-control-lg bg-light fs-6" type="text"  placeholder="Email" name="email">
                        </div>
                        @error('email')
                        <span class="error-message">{{ $message }} </span>
                        @enderror
                        <div class="input-group mb-1">
                            <input  class="form-control form-control-lg bg-light fs-6"  type="password" placeholder="Senha" name="password">
                        </div>
                        @error('password')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                        @error('error')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                        <button style="background-color:#2e2e2e;border: none;" class="btn btn-lg btn-primary w-100 fs-6" type="submit">Login</button>
                        <p class="message">Não possui uma conta? <a style="text-decoration: none;color: #656565" href="{{ route('user.create') }}"> Cadastre-se</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
