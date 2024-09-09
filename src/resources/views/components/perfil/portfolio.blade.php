
<section>
    <div class="d-flex flex-column align-items-center justify-content-center pb-3">
        @if(auth()->id() == $user['id'] && !$favoritos)
            <button id="btn-create-project" class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#createProjectModal"  ><i class="bi bi-file-earmark-plus-fill"></i></button>
        @endif
    </div>


    <x-projeto.grid-projetos :projects="$projects"/>
    <div class="empt"> {{ $projects->links() }} </div>
</section>
