<div class = "sideBar mainperfil">
    <div class = "user mainperfil">
        @if($user['foto'] != null)
            <img class="userImg mainperfil" src="{{ asset('storage/arquivos/'. $user['id'] . '/' . $user['foto']) }}" alt="foto perfil">
        @else
            <img class="userImg mainperfil" src="/img/profile-img.png" alt="profile pic" />
        @endif
        <div class="userInfo mainperfil">
            <p class="name mainperfil">{{ $user['nome'] }} </p>
            <p class="apelido mainperfil">{{ $user['apelido']}}</p>
        </div>
    </div>

    <button onclick="openModal('box-show-followeds')" class="userFollowers" type="submit"> Seguidores {{ $user->seguidores()->count() }}</button>

    <button onclick="openModal('box-show-followers')" class="userFollowers" type="submit"> Seguindo {{ $user->seguindo()->count() }}</button>

    @if(auth()->id() == $user['id'])
        <form action="{{route('user.updateDisp', $user['id'])}}" method="post">
            @csrf
            @endif
            @if($user['disponivel'])
                <button type="submit" class="disp-btn green-disp-btn">Disponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></button>
            @else
                <button  type="submit" class="disp-btn red-disp-btn">Indisponível <img class="disp-info-icon" src="/img/info-icon.png"  onmouseover="showMessage()" onmouseout="hideMessage()"> </button>
            @endif
            <div id="disp-info-text">
            </div>
            @if(auth()->id() == $user['id'])
        </form>
    @endif


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
            <form id="follow" method="post" action="{{ route('user.follow', $user['id']) }}" >
                @csrf
                <button class="follow-btn unfollow" type="submit">Seguir</button>
            </form>
        @else
            <form id="unfollow" method="post" action="{{ route('user.unfollow', $user['id']) }}" >
                @csrf
                <button class="follow-btn follow" type="submit">Seguindo</button>
            </form>
        @endif
    @endif
</div>
