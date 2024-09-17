<dialog  >
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seguidoresModal">
        Launch demo modal
    </button>
</dialog>




<!-- Modal -->
<div class="modal fade" id="seguidoresModal" tabindex="-1" aria-labelledby="seguidoresModalLabel" aria-hidden="true">
    <script>
        function closeModal3() {
            $('#seguidoresModal').modal('hide');  // Hides the modal
        }
    </script>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Seguidores</h1>
                <button onclick="closeModal3(); resetModal();" type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                    @foreach($seguidores as $seguidor)
                        <x-usuario.mini-view-usuario :user="$seguidor" :userPerfil="$userPerfil"/>
                    @endforeach
            </div>
            <div class="modal-footer">
                {{ $seguidores->links() }}
            </div>
        </div>
    </div>
</div>
