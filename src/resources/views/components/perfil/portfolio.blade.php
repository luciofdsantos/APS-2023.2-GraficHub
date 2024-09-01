<div class="portifolio mainperfil mainshadowdown">
    @if(auth()->id() == $user['id'])
        <button class="mainshadowdown portBox" onclick="openModal('box-create-project')" id="btn-create-project">+</button>
    @endif
    <x-projeto.grid-projetos :projects="$projects"/>
    <div class="empt"> {{ $projects->links() }} </div>
</div>
