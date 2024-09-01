<div class="containerss">


    <x-projeto.side-bar-projeto :project="$project"/>

    <div class="imagens maincaro">
        <div class="carousel-container">
            <div class="carousel">
                <div class="item active">
                    <img src = "{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="">
                    <p class="caption">Imagem de Capa</p>
                </div>
                @foreach($images as $image)
                    <div class="item">
                        <img src="{{ asset('storage/arquivos/'. $project->user_id . '/' . $project->id . '/' .'imgs'.'/'.$image->name)}}" alt="">
                    </div>
                @endforeach
            </div>
            <button class="btn prev"><</button>
            <button class="btn next"> ></button>
            <div class="dots"></div>
        </div>

    </div>
</div>
