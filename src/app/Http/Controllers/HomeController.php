<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', '<>', auth()->id())->orderBy('created_at', 'desc')->cursorPaginate(9);
        return view('home', compact('projects'));
    }

    public function personalizado(){
        if (auth()->check()) {
            $seguindo = auth()->user()->seguindo()->pluck('users.id')->toArray();
            $projects = Project::whereIn('user_id', $seguindo)->orderBy('created_at', 'desc')->cursorPaginate(9);
            return view('home', ['projects' => $projects, 'personalizado' => true]);
        } else {
            return redirect()->route('auth.loginForm');
        }
    }
}
