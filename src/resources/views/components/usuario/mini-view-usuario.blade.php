<div class="content-contaneir" style="margin-bottom: 10px;">
    <div class="content">
        @if($user['foto'] != null)
            <img class="follow-img" src="{{ asset('storage/arquivos/'. $user['id'] . '/' . $user['foto']) }}" alt="profile-pic">
        @else
            <img class="follow-img" src="/img/profile-img.png" alt="profile pic" />
        @endif
        <p class="apelidof">{{ $user->apelido }}</p>
        @if(auth()->id() != $user->id)
            @if(!auth()->check() || !auth()->user()->isSeguindo($user->id))
                <form action="{{ route('user.follow', $user->id) }}" method="post">
                    @csrf
                    <button class= "follow-btn unfollow" type="submit">Seguir</button>
                </form>
            @else
                <form action="{{ route('user.unfollow', $user->id) }}" method="post">
                    @csrf
                    <button class="follow-btn follow" type="submit">Seguindo</button>
                </form>
            @endif
        @endif
    </div>
</div>
