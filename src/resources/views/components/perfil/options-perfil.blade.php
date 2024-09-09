<div>
        @if(auth()->id() == $user['id'])
        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    openModal(localStorage.getItem('lastModal'));
                });
            </script>
        @endif


        <button id = "edt-btn"  class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#EditProfileModal">Editar Perfil</button>
        <a  id="remove-color" class="btn btn-outline-danger" onclick="confirmLogout(event)" href ="{{route('auth.logout')}}">LogOut</a>

    @else

        <div class="d-flex gap-2">
        @if(!auth()->check() || !auth()->user()->isSeguindo($user['id']))
            <form id="follow" method="get" action="{{ route('user.follow', ['apelido' => $user['apelido'], 'id' => $user['id']]) }}" >
                @csrf
                <button id="follow-btn" class="btn btn-outline-success" type="submit">Seguir</button>
            </form>
        @else
            <form id="unfollow" method="get" action="{{ route('user.unfollow', ['apelido' => $user['apelido'], 'id' => $user['id']]) }}" >
                @csrf
                <button id="unfollow-btn" class="btn btn-outline-danger" type="submit">Seguindo</button>
            </form>
        @endif
        </div>
    @endif


</div>


