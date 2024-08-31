<dialog id="box-show-followeds">

    <div>
        <div class="follow-box">
            <div class="header-modal">
                <p class="title-box"><heavy>Seguidores</heavy></p>
                <a onclick="closeModal('box-show-followeds')" class="close-modal" ><img class="close-modal-img" src="/img/cruz.png"></a>
            </div>
            @foreach($seguidores as $follower)
                <div class="content-contaneir" style="margin-bottom: 10px;">
                    <div class="content">
                        @if($follower['foto'] != null)
                            <img class="follow-img" src="{{ asset('storage/arquivos/'. $follower['id'] . '/' . $follower['foto']) }}" alt="profile-pic">
                        @else
                            <img class="follow-img" src="/img/profile-img.png" alt="profile pic" />
                        @endif

                        <p class="apelidof">{{ $follower->apelido }}</p>
                        @if(auth()->id() != $follower->id)
                            @if(!auth()->check() || !auth()->user()->isSeguindo($follower->id))
                                <form action="{{ route('user.follow', $follower->id) }}" method="post">
                                    @csrf
                                    <button class= "follow-btn unfollow" type="submit">Seguir</button>
                                </form>
                            @else

                                <form action="{{ route('user.unfollow', $follower->id) }}" method="post">
                                    @csrf
                                    <button class="follow-btn follow" type="submit">Seguindo</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
            {{ $seguidores->links() }}
        </div>
    </div>
</dialog>
