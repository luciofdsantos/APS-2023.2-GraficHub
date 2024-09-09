<dialog id="comment-modal">
    <a onclick="closeModal('comment-modal')" class="close-modal" ><img class="close-modal-img" src="/img/cruz.png"></a>
    <div class="container-comments">
        <form class="forms" action="{{ route('comment.store')}}" method="post">
            @csrf
            <input class="mainshadowdown" type="hidden" placeholder="id" name="project_id" value="{{ $project->id }}">
            <input class="mainshadowdown" type="text" placeholder="Comentario" name="comentario"
                   value="{{ old('comentario') }}">
            @error('comentario')
            <span class="error-message">
                    {{ $message }}
                </span>
            @enderror
            <button onclick="setComment()" class="mainshadowdown" type="submit">Publicar</button>
        </form>

        <h2 class="mt-4 title">Comentários</h2>
        @if($project->comentarios->isEmpty())
            <p>Nenhum comentário ainda.</p>
        @else
            <ul class="list-group">
                @foreach($project->comentarios as $comment)
                    @if($comment->apagado)
                    @else
                        <li class="list-group-item-main">


                            <p><strong>{{ $comment->comentario }}</strong></p>
                            <small>Por: {{ $comment->user->apelido }}</small>
                            <small>{{ $comment->updated_at->format('d/m/Y H:i:s') }}</small>

                            @if(auth()->check() && auth()->id() == $comment->user_id)
                                <form  method="post" action="{{ route('comment.delete', $comment->id) }}" >
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="setComment()" id="excluirbtn" type="submit" >Excluir</button>
                                </form>
                            @endif
                            @endif
                            @if($comment->apagado)
                            @else
                                <form class="forms" action="{{ route('comment.store') }}" method="post">
                                    @csrf
                                    <input class="mainshadowdown" type="hidden" placeholder="id" name="project_id"
                                           value="{{ $project->id }}">
                                    <input class="mainshadowdown" type="hidden" placeholder="id" name="comentario_pai"
                                           value="{{ $comment->id }}">
                                    <input class="mainshadowdown" type="text" placeholder="responder {{ $comment->user->name }}" name="comentario"
                                           value="{{ old('comentario') }}">
                                    @error('comentario')
                                    <span class="error-message">
                            {{ $message }}
                        </span>
                                    @enderror
                                    <button onclick="setComment()" class="mainshadowdown" type="submit">Responder</button>
                                </form>

                                @if($comment->respostas->isNotEmpty() && !$comment->apagado)
                                    <ul class="list-group mt-2">
                                        @foreach($comment->respostas as $resposta)
                                            <li class="list-group-item">
                                                <p><strong>{{ $resposta->comentario }}</strong></p>
                                                <small>Por: {{ $resposta->user->apelido }}</small>
                                                <small>{{ $resposta->updated_at->format('d/m/Y H:i:s') }}</small>

                                                @if(auth()->check() && auth()->id() == $resposta->user_id && !$resposta->apagado)
                                                    <form  method="post" action="{{ route('comment.delete', $resposta->id) }}" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="setComment()" id="excluirbtn" type="submit" >Excluir</button>
                                                    </form>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
</dialog>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
        </div>
        <div class="dropdown mt-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Dropdown button
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>
</div>
