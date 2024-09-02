<!-- resources/views/comments.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/projectfullview.css" rel="stylesheet">
    <title>Comentários</title>
</head>
<body>
<div class="container-comments">

    <form class="forms" action="{{ route('comment.store') }}" method="post">
        @csrf
        <input class="mainshadowdown" type="hidden" placeholder="id" name="project_id" value="{{ $project->id }}">
        <input class="mainshadowdown" type="text" placeholder="Comentario" name="comentario"
               value="{{ old('comentario') }}">
        @error('comentario')
        <span class="error-message">
                    {{ $message }}
                </span>
        @enderror
        <button class="mainshadowdown" type="submit">Publicar</button>
    </form>

    <h2 class="mt-4 title">Comentários</h2>
    @if($comentarios->isEmpty())
        <p>Nenhum comentário ainda.</p>
    @else
        <ul class="list-group">
            @foreach($comentarios as $comment)
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
                                <button id="excluirbtn" type="submit" >Excluir</button>
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
                        <button class="mainshadowdown" type="submit">Responder</button>
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
                                            <button id="excluirbtn" type="submit" >Excluir</button>
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
</body>
</html>
