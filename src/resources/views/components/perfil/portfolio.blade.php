
<section>
    <div class="d-flex flex-column align-items-center justify-content-center pb-2">
        @if(auth()->id() == $user['id'] && !$favoritos)
            <button id="btn-create-project" class="btn btn-secondary btn-lg" onclick="openModal('box-create-project')" >+</button>
        @endif
    </div>


    <x-projeto.grid-projetos :projects="$projects"/>
    <div class="empt"> {{ $projects->links() }} </div>
</section>
