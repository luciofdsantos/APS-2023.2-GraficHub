<dialog onload="setDirectionFollow('seguidores')" id="box-show-followeds">

    <div>
        <div class="follow-box">
            <div class="header-modal">
                <p class="title-box"><heavy>Seguidores</heavy></p>
                <a onclick="closeModal('box-show-followeds');resetDirectionFollow()" class="close-modal" ><img class="close-modal-img" src="/img/cruz.png"></a>
            </div>
            @foreach($seguidores as $seguidor)
                <x-usuario.mini-view-usuario :user="$seguidor" />
            @endforeach
            {{ $seguidores->links() }}
        </div>
    </div>
</dialog>
