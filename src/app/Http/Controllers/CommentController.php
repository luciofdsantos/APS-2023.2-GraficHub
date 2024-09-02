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
    public function show(int $project_id)
    {
        $project = Project::find($project_id);
        if ($project == null) {
            abort(404);
        }
        $comentarios = $project->comentarios()->orderBy('created_at', 'desc')->get();
        return view('project.showComments', compact('comentarios', 'project'));
    }

    public function store(CommentRequest $request)
    {

        $request->validated();

        if (!auth()->check()) {
            abort(401);
        }

        $comentario = Comment::create([
            'comentario' => $request->comentario,
            'project_id' => $request->project_id,
            'user_id' => auth()->id(),
            'comentario_pai' => $request->comentario_pai ?? null,
        ]);

        $comentario->save();

        return redirect()->route('comment.show', $comentario->project_id);
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
        return redirect()->route('comment.show', $comment->project_id);
    }
}
