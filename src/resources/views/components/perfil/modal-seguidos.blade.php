<dialog >
    <div>
        <div class="follow-box">
            <div class="header-modal">
                <p class="title-box"><heavy>Seguindo</heavy></p>
                <a onclick="closeModal('box-show-followers');resetDirectionFollow()" class="close-modal" ><img class="close-modal-img" src="/img/cruz.png"></a>
            </div>


        </div>
    </div>
</dialog>

<div class="modal fade" id="seguindoModal" tabindex="-1" aria-labelledby="seguindoModallabel" aria-hidden="true">    <script>
        function closeModal() {
            $('#seguindoModal').modal('hide');  // Hides the modal
        }
    </script>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Seguindo</h1>
                <button onclick="closeModal(); resetModal();" type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @foreach($seguindo as $follower)
                    <x-usuario.mini-view-usuario :user="$follower"  :userPerfil="$userPerfil"/>
                @endforeach

            </div>
            <div class="modal-footer">
                {{ $seguindo->links() }}
            </div>
        </div>
    </div>
</div>
