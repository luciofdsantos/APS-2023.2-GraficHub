<div style=" overflow-y: auto;height: 100vh;" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasComments" aria-labelledby="offcanvasCommentsLabel">
    <script>
        function closeOff() {
            $('#offcanvasComments').offcanvas('hide');  // Hides the modal
        }
    </script>
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Comentários</h5>
        <button onclick="closeOff();resetModal()" type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" >
        <form class="forms" action="{{ route('comment.store')}}" method="post">
            @csrf
            <input class="mainshadowdown" type="hidden" placeholder="id" name="project_id" value="{{ $project->id }}">
            <div class="input-group mb-1">
                <textarea  placeholder="Comentario" name="comentario" class="form-control" aria-label="With textarea"></textarea>
            </div>

            @error('comentario')
            <span class="error-message">
                    {{ $message }}
                </span>
            @enderror
            <div class=" d-flex  justify-content-end">
                <button onclick="setComment()" class="btn btn-secondary" type="submit"  >Publicar</button>
            </div>
        </form>
        @if($project->comentarios->isEmpty())
            <p>Nenhum comentário ainda.</p>
        @else
            <ul class="list-group">
                @foreach($project->comentarios as $comment)
                    @if($comment->apagado)
                    @else
                        <li  style="list-style: none" class="list-group-item-main">
                            <div class="d-flex mb-1 mt-2">
                                <a style="text-decoration: none; color: #1e1e1e" href="{{ route('user.perfil', $comment->user->apelido) }}" class="d-flex  align-items-center gap-1">
                                    @if($comment->user['foto'] != null)
                                        <img class="img-comment" src="{{ asset('storage/arquivos/'. $comment->user['id'] . '/' .$comment->user['foto']) }}"  alt="profile pic">
                                    @else
                                        <img class="img-comment" src="/img/profile-img.png" alt="profile pic" />
                                    @endif
                                    <strong style="font-size: 14px">{{ $comment->user->apelido }}</strong>
                                </a>
                            </div>
                            <div style="text-align: justify;">
                                <p>{{ $comment->comentario }}</p>
                            </div>

                            <div class="d-flex justify-content-start">
                                <small>{{ $comment->updated_at->format('d/m/Y H:i:s') }}</small>
                            </div>
                            <div class="d-flex justify-content-end">
                                @if(auth()->check() && auth()->id() == $comment->user_id)
                                    <form  method="post" action="{{ route('comment.delete', $comment->id) }}" >
                                        @csrf
                                        @method('DELETE')
                                        <button  id="remove-color" class="btn btn-outline-danger" onclick="setComment()"  type="submit" >Excluir</button>
                                    </form>
                                @endif
                            </div>

                            @endif
                            @if($comment->apagado)
                            @else
                                <form class="forms" action="{{ route('comment.store') }}" method="post">
                                    @csrf
                                    <input class="mainshadowdown" type="hidden" placeholder="id" name="project_id"
                                           value="{{ $project->id }}">
                                    <input class="mainshadowdown" type="hidden" placeholder="id" name="comentario_pai"
                                           value="{{ $comment->id }}">
                                    <div class="input-group mb-1 mt-2">
                                        <textarea  placeholder="responder {{ $comment->user->name }}" type="text"  name="comentario" class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                    @error('comentario')
                                    <span class="error-message">{{ $message }}</span>
                                    @enderror
                                    <div class=" d-flex  justify-content-end">
                                        <button onclick="setComment()" class="btn btn-secondary" type="submit">Responder</button>
                                    </div>
                                </form>

                                @if($comment->respostas->isNotEmpty() && !$comment->apagado)
                                    <ul class="list-group mt-2">
                                        @foreach($comment->respostas as $resposta)
                                            <li class="list-group-item">
                                                <div class="d-flex mb-1">
                                                    <a style="text-decoration: none; color: #1e1e1e" href="{{ route('user.perfil', $resposta->user->apelido) }}" class="d-flex  align-items-center gap-1">
                                                        @if($resposta->user['foto'] != null)
                                                            <img class="img-comment" src="{{ asset('storage/arquivos/'. $resposta->user['id'] . '/' .$resposta->user['foto']) }}"  alt="profile pic">
                                                        @else
                                                            <img class="img-comment" src="/img/profile-img.png" alt="profile pic" />
                                                        @endif
                                                        <strong style="font-size: 14px"> {{ $resposta->user->apelido }}</strong>
                                                    </a>
                                                </div>
                                                <div style="text-align: justify;">
                                                    <p>{{ $resposta->comentario }}</p>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <small>{{ $resposta->updated_at->format('d/m/Y H:i:s') }}</small>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    @if(auth()->check() && auth()->id() == $resposta->user_id && !$resposta->apagado)
                                                        <form  method="post" action="{{ route('comment.delete', $resposta->id) }}" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button  id="remove-color" class="btn btn-outline-danger" onclick="setComment()"  type="submit" >Excluir</button>
                                                        </form>
                                                    @endif
                                                </div>
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
</div>
