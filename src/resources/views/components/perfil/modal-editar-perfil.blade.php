<dialog id ="box-edit-profile">
    <div class="user-form-container">
        <div class="main">

        </div>
    </div>
</dialog>

<!-- Modal -->
<div class="modal fade" id="EditProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Atualizar Dados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="forms" action="{{ route('user.update', $user['apelido']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <input  class="form-control form-control-lg bg-light fs-6" type="text" placeholder="nome" name="nome" value="{{ old('nome', $user['nome']) }}">
                    </div>
                    @error('nome')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6" type="text" placeholder="apelido" name="apelido" value="{{ old('apelido', $user['apelido']) }}">
                    </div>
                     @error('apelido')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input  class="form-control form-control-lg bg-light fs-6" type="text" placeholder="número de telefone" name="numero_telefone" value="{{ old('numero_telefone', $user['numero_telefone']) }}">
                    </div>
                     @error('numero_telefone')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6" type="text" placeholder="email" name="email" value="{{ old('email', $user['email']) }}">
                    </div>
                    @error('email')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6" type="password" placeholder="Nova senha" name="password">
                    </div>

                    @error('password')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input class="form-control form-control-lg bg-light fs-6" type="password" placeholder="confirme a nova senha" name="password_confirmation">
                    </div>
                    <div class="input-group mb-3">
                        <label class="form-control form-control-lg bg-light fs-6 custom-file-upload" for="file-upload-profile">Foto de Perfil</label>
                    </div>

                    <input  style="visibility: hidden" id="file-upload-profile" type="file" name="foto" placeholder="Foto de Perfil">
                    @error('foto')
                    <span class="error-message">
                    {{ $message }}
                </span>
                    @enderror
                    <div class="modal-footer">
                        <button onclick="setModal('box-edit-profile')" class="btn btn-secondary" type="submit">Atualizar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
