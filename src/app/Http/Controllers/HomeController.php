<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', '<>', auth()->id())->orderBy('created_at', 'desc')->cursorPaginate(6);
        session(['goBack' => url()->current()]);
        return view('home', compact('projects'));
    }

    public function personalizado(){
        session(['goBack' => url()->current()]);
        if (auth()->check()) {
            $seguindo = auth()->user()->seguindo()->pluck('users.id')->toArray();
            $projects = Project::whereIn('user_id', $seguindo)->orderBy('created_at', 'desc')->cursorPaginate(9);
            return view('home', ['projects' => $projects, 'personalizado' => true]);
        } else {
            return redirect()->route('auth.loginForm');
        }
    }

    public function busca(Request $request){
        $string = $request->query('string');
        $vetorTags = explode(' ', $string);

        $projects = Project::whereHas('tags', function (Builder $query) use ($vetorTags) {
            $query->whereIn('tags.nome', $vetorTags);
        })
            ->where('user_id', '<>', auth()->id())
            ->orderBy($request->query('filtro'), $request->query('ordem'))
            ->cursorPaginate(6);

        session(['goBack' => url()->current()]);
        return view('homeBusca', compact('projects', 'string'));

    }
}
