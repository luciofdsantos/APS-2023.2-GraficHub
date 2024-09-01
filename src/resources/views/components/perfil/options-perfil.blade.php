<div>
    <div class="mainperfil options">
    </div>
    @if(auth()->id() == $user['id'])
        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    openModal(localStorage.getItem('lastModal'));
                });
            </script>
        @endif
        <button id = "btn-edit-profile" onclick="openModal('box-edit-profile')" class="edit mainshadowdown">Editar Perfil</button>
        <a class="logout mainshadowdown" onclick="confirmLogout(event)" href ="{{route('auth.logout')}}">LogOut</a>

    @else
        <button onclick="openModal('box-fone')" id="btn-telefone" class="disp-btn telefone"> Telefone </button>
        <button onclick="openModal('box-email')" id="btn-email" class="disp-btn email"> Email </button>
        @if(!auth()->check() || !auth()->user()->isSeguindo($user['id']))
            <form id="follow" method="get" action="{{ route('user.follow', $user['id']) }}" >
                @csrf
                <button class="follow-btn unfollow" type="submit">Seguir</button>
            </form>
        @else
            <form id="unfollow" method="get" action="{{ route('user.unfollow', $user['id']) }}" >
                @csrf
                <button class="follow-btn follow" type="submit">Seguindo</button>
            </form>
        @endif
    @endif
</div>
