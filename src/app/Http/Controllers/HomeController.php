<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', '<>', auth()->id())->orderBy('created_at', 'desc')->cursorPaginate(3);
        return view('home', compact('projects'));
    }
}
