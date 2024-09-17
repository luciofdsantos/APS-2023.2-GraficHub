<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', '<>', auth()->id())->orderBy('created_at', 'desc')->cursorPaginate(10);
        session(['goBack' => url()->current()]);
        return view('home', compact('projects'));
    }

    public function personalizado()
    {
        session(['goBack' => url()->current()]);
        if (auth()->check()) {
            $seguindo = auth()->user()->seguindo()->pluck('users.id')->toArray();
            $projects = Project::whereIn('user_id', $seguindo)->orderBy('created_at', 'desc')->cursorPaginate(10);
            return view('home', ['projects' => $projects, 'personalizado' => true]);
        } else {
            return redirect()->route('auth.loginForm');
        }
    }

    public function busca(Request $request)
    {
        $string = $request->query('string');
        $vetorTags = explode(' ', $string);

        $consulta = Project::whereHas('tags', function (Builder $query) use ($vetorTags) {
            $query->whereIn('tags.nome', $vetorTags);
        })
            ->where('user_id', '<>', auth()->id());

        if ($request->query('disponivel') == 'sim') {
            $consulta = $consulta->whereHas('user', function (Builder $query) use ($vetorTags) {
                $query->where('users.disponivel', true);
            });
        }
        $projects = $consulta->orderBy($request->query('filtro'), $request->query('ordem'))
            ->cursorPaginate(10);
        session(['goBack' => url()->current()]);
        $filtros = [
            'busca' => $request->query('string'),
            'filtro' => $request->query('filtro'),
            'ordem' => $request->query('ordem'),
            'disponivel' => $request->query('disponivel'),
        ];
        return view('homeBusca', compact('projects', 'filtros'));

    }
}
