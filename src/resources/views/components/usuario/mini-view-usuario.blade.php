<div class="d-flex" style="margin-bottom: 10px;">
        <a style=" text-decoration: none; color: #1e1e1e" href="{{ route('user.perfil', $user->apelido) }}" class=" d-flex  align-items-center gap-1">
            @if($user['foto'] != null)
                <img class="img-comment" src="{{asset('storage/arquivos/'. $user['id'] . '/' . $user['foto']) }}" alt="profile-pic">
            @else
                <img class="img-comment" src="/img/grafichub.png" alt="profile pic" />
            @endif
            <strong style="font-size: 16px" class="apelido">{{ $user->apelido }}</strong>
        </a>
        <div  style="position: absolute; right: 10px;" class=" d-flex justify-content-end">
            @if(auth()->id() != $user->id)
                @if(!auth()->check() || !auth()->user()->isSeguindo($user->id))
                    <form action="{{ route('user.follow', ['apelido' => $userPerfil->apelido, 'id' => $user->id]) }}" method="get">
                        @csrf
                        <button style="justify-self: end" class= "btn btn-outline-success" type="submit">Seguir</button>
                    </form>
                @else
                    <form action="{{ route('user.unfollow', ['apelido' => $userPerfil->apelido, 'id' => $user->id]) }}" method="get">
                        @csrf
                        <button class="btn btn-outline-danger" type="submit">Seguindo</button>
                    </form>
                @endif
            @endif
        </div>
</div>
