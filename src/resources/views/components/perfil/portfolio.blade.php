<div class="portifolio mainperfil mainshadowdown">
    @if(auth()->id() == $user['id'] && !$favoritos)
        <button class="mainshadowdown portBox" onclick="openModal('box-create-project')" id="btn-create-project">+</button>
    @endif
    @if($favoritos)
        <div class="projetos-favoritos-label">Favoritos</div>
    @endif
    <x-projeto.grid-projetos :projects="$projects"/>
    <div class="empt"> {{ $projects->links() }} </div>
</div>
