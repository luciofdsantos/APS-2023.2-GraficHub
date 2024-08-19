<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
//        dd($request);
        $request->validated();

        $user = auth()->user();

        $coverImgName = time() . '_' . $request->file('imagem_capa')->getClientOriginalName();

        $projectFileName = null;
        if($request->file('arquivo') != null){
            $projectFileName = time() . '_' . $request->file('arquivo')->getClientOriginalName();
        }

        $project = Project::create([
            'user_id' => $user->id,
            'titulo' => $request->titulo,
            'imagem_capa' => $coverImgName,
            'ferramentas' => $request->ferramentas,
            'descricao' => $request->descricao,
            'tags' => $request->tags,
            'arquivo' => $projectFileName,
            'arquivo_publico' => $request->arquivo_publico == 'on' ? 1 : 0
        ]);

        $request->file('imagem_capa')->move(public_path('storage/arquivos/' . $user->id . '/' . $project->id), $coverImgName);
        if($request->file('arquivo') != null){
            $request->file('arquivo')->move(public_path('storage/arquivos/' . $user->id . '/' . $project->id), $projectFileName);
        }
        $nImgs = count($request->imagens);
        for($i = 0; $i < $nImgs; $i++){
            $imgFileName = $request->imagens[$i]->getClientOriginalName();
            $request->imagens[$i]->move(public_path('storage/arquivos/' . $user->id . '/' . $project->id . '/imgs'), $imgFileName);
        }

        return redirect()->route('user.perfil', $user->apelido);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $projectModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $projectModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $projectModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $projectModel)
    {
        //
    }
}
