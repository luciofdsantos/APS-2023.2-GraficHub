<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Project;

class CommentController extends Controller
{
    /**
     * Exibe todos os comentarios de um projeto
     */


    public function store(CommentRequest $request)
    {

        $request->validated();

        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }

        $comentario = Comment::create([
            'comentario' => $request->comentario,
            'project_id' => $request->project_id,
            'user_id' => auth()->id(),
            'comentario_pai' => $request->comentario_pai ?? null,
        ]);

        $comentario->save();
        return redirect()->route('project.show', $comentario->project_id);
    }

    public function destroy(int $comment_id){

        $comment = Comment::find($comment_id);
        if (!auth()->check() || auth()->id() != $comment->user_id) {
            abort(401);
        }

        if ($comment->respostas()->exists()) {
            $comment->apagado = true;
            $comment->save();
        } else {
            $comment->delete();
        }
        return redirect()->route('project.show', $comment->project_id);
    }
}
