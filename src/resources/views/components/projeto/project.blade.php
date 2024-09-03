<div class="project-main-content">


    <x-projeto.side-bar-projeto :project="$project"/>

    <div class="project-images">
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
            <div class="favorite-like-wrapper">
                @if(auth()->check())
                    <label class="favorite-container grow-on-hover">
                        <input id="favorite-checkbox" type="checkbox" name="{{$project->id}}">
                        <svg viewBox="0 0 26 26"><path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/></svg>
                    </label>
                        <div id="favorites-number">0</div>
                @else
                    <label class="favorite-container grow-on-hover">
                        <a type="checkbox" href="{{route('project.favoritar', $project->id)}}">
                            <svg viewBox="0 0 26 26"><path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/></svg>
                        </a>
                    </label>
                            <div id="favorites-number">0</div>
                @endif
                @if(auth()->check())
                    <label class="like-container grow-on-hover">
                        <input id="like-checkbox" type="checkbox" name="{{$project->id}}">
                        <svg id="Layer_1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path xmlns="http://www.w3.org/2000/svg" d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"/></svg>
                    </label>
                        <div id="likes-number">0</div>
                @else
                    <label class="like-container grow-on-hover">
                        <a type="checkbox" href="{{route('project.curtir', $project->id)}}">
                            <svg id="Layer_1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path xmlns="http://www.w3.org/2000/svg" d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"/></svg>
                        </a>
                    </label>
                            <div id="likes-number">0</div>
                @endif
            </div>
        </div>

    </div>
</div>
