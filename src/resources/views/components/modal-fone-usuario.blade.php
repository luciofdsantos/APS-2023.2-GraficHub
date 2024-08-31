<dialog id="box-fone">
    <div><a  class="close-modal" onclick="closeModal('box-fone')"><img class="close-modal-img" src="/img/cruz.png"></a></div>
    <div class="contact-container">
        <div class="content-contact">
            <img class="icon" src="/img/fone.png" alt="fone icon">
            <div class="text-box"><p class="text"> {{ $user->numero_telefone }}</p></div>
        </div>
    </div>
</dialog>
