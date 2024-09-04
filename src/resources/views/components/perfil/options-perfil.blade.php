<div>
    @if(auth()->id() == $user['id'])
        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    openModal(localStorage.getItem('lastModal'));
                });
            </script>
        @endif


        <button id = "btn-edit-profile" onclick="openModal('box-edit-profile')" class="btn btn-outline-warning">Editar Perfil</button>
        <a class="btn btn-outline-danger" onclick="confirmLogout(event)" href ="{{route('auth.logout')}}">LogOut</a>

    @else

        <div class="d-flex gap-2">
        @if(!auth()->check() || !auth()->user()->isSeguindo($user['id']))
            <form id="follow" method="get" action="{{ route('user.follow', ['apelido' => $user['apelido'], 'id' => $user['id']]) }}" >
                @csrf
                <button class="btn btn-outline-success" type="submit">Seguir</button>
            </form>
        @else
            <form id="unfollow" method="get" action="{{ route('user.unfollow', ['apelido' => $user['apelido'], 'id' => $user['id']]) }}" >
                @csrf
                <button class="btn btn-outline-danger" type="submit">Seguindo</button>
            </form>
        @endif
        </div>
    @endif


</div>


