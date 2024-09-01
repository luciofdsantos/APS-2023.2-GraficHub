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

    <x-perfil.disponibilidade :user="$user" />

    <x-perfil.options-perfil :user="$user" />

</div>
