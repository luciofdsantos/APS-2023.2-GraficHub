<dialog id="box-show-followers">
    <div>
        <div class="follow-box">
            <div class="header-modal">
                <p class="title-box"><heavy>Seguindo</heavy></p>
                <a onclick="closeModal('box-show-followers')" class="close-modal" ><img class="close-modal-img" src="/img/cruz.png"></a>
            </div>

            @foreach($seguindo as $follower)
                <x-usuario.mini-view-usuario :user="$follower" />
            @endforeach
            {{ $seguindo->links() }}
        </div>
    </div>
</dialog>
