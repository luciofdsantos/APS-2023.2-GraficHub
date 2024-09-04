<!--
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

    <button onclick="openModal('box-show-followeds'); setDirectionFollow('followed');" class="userFollowers" type="submit"> Seguidores {{ $user->num_seguidores }}</button>

    <button onclick="openModal('box-show-followers'); setDirectionFollow('follower');" class="userFollowers" type="submit"> Seguindo {{ $user->num_seguindo }}</button>

    @if($favoritos)
        <form action="{{route('user.perfil', $user->apelido)}}" method="get">
            <button class="list-favorites-btn" type="submit">Meus Projetos</button>
        </form>
    @else
        <form action="{{route('user.favoritos', $user->apelido)}}" method="get">
            <button class="list-favorites-btn" type="submit">Favoritos</button>
        </form>
    @endif

    <x-perfil.disponibilidade :user="$user" />



</div>
-->
<section>
    <div  class="container  main-perfil">
        <div class="row g-0 text-center">
            <div  class=" d-flex flex-column col-4 col-md-2 align-items-center gap-2 ">
                @if($user['foto'] != null)
                    <img class="img-holder " src="{{ asset('storage/arquivos/'. $user['id'] . '/' . $user['foto']) }}" alt="foto perfil">
                @else
                    <img class="img-holder" src="/img/profile-img.png" alt="profile pic" />
                @endif
                <div>
                    <h1 class="nickname" >{{ $user['apelido']}}</h1>
                    <h1 class="name" >  {{ $user['nome'] }}</h1>
                </div>
            </div>
        <div  class="col-sm-8 col-md-10">
               <div class="container">
                   <div class="row d-flex">
                       <div class="container d-flex justify-content-end align-items-center">
                           <x-perfil.options-perfil :user="$user" />
                       </div>
                   </div>
                   <div class="row d-flex">
                       <div class="container d-flex justify-content-center align-items-center">
                           <button onclick="openModal('box-show-followeds'); setDirectionFollow('followed');" class=" btn btn-outline" type="submit"> {{ $user->num_seguidores }} <heavy style ="font-weight: 600"> @if(  $user->num_seguidores ==1)Seguidor @else Seguidores @endif </heavy> </button>
                           <button onclick="openModal('box-show-followers'); setDirectionFollow('follower');" class="btn btn-outline" type="submit"> {{ $user->num_seguindo }} <heavy style ="font-weight: 600"> Seguindo</heavy>   </button>
                       </div>
                   </div>
                   <div class="row d-flex">
                       <div class="container d-flex justify-content-center align-items-center">
                           <x-perfil.disponibilidade :user="$user" />
                       </div>
                   </div>
                   <div class="row d-flex">
                       <div class="container d-flex justify-content-center align-items-center">
                           @if(auth()->id() != $user['id'])
                               <button onclick="openModal('box-fone')"  class="btn btn-outline"> <i class="bi bi-telephone"> </i> </button>
                               <button onclick="openModal('box-email')" class="btn btn-outline"> <i class="bi bi-envelope"></i> </button>
                           @endif
                       </div>
                   </div>

               </div>
        </div>
        </div>
    </div>
</section>
<section>

</section>
