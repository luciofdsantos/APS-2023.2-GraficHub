<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\ImagesProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $request->validated();

        $request->validate([
            'imagens.*' => ['mimes:jpg,png,jpeg,webp,svg', 'max:5120'],
        ], [
            'imagens.*.mimes' => 'O arquivo deve ser uma imagem (jpg, jpeg, webp, svg ou png).',
            'imagens.*.max' => 'O tamanho máximo do arquivo é :max KB.'
        ]);

        $user = auth()->user();

        $coverImgName = time() . '_' . $request->file('imagem_capa')->getClientOriginalName();

        $projectFileName = null;
        if ($request->file('arquivo') != null) {
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
        if ($request->file('arquivo') != null) {
            $request->file('arquivo')->move(public_path('storage/arquivos/' . $user->id . '/' . $project->id), $projectFileName);
        }
        $nImgs = count($request->imagens);
        for ($i = 0; $i < $nImgs; $i++) {
            $imgFileName = time() . '_' . $request->imagens[$i]->getClientOriginalName();
            ImagesProject::create([
                'project_id' => $project->id,
                'name' => $imgFileName,
            ]);
            $request->imagens[$i]->move(public_path('storage/arquivos/' . $user->id . '/' . $project->id . '/imgs'), $imgFileName);
        }

        return redirect()->route('user.perfil', $user->apelido);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('id', auth()->id())->first();
        if (!auth()->check()) {
            abort(403);
        }

        return view('project.create', compact('user'));
    }

    /**
     * Display the specified resource.
     * @param int $id id do projeto
     */
    public function show(int $id)
    {
        $project = Project::find($id);
        if ($project == null) {
            abort(404);
        }
        $images = $project->imagesProjects()->paginate(1);;
        return view('project.show', compact('project', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $project = Project::find($id);
        if ($project == null) {
            abort(404);
        } elseif ($project->user_id != auth()->id()) {
            abort(403);
        }
        return view('project.edit', compact('project'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, int $id)
    {
        $request->validated();

        if ($request->file('imagens') != null) {
            $request->validate([
                'imagens.*' => ['mimes:jpg,png,jpeg,webp,svg', 'max:5120'],
            ], [
                'imagens.*.mimes' => 'O arquivo deve ser uma imagem (jpg, jpeg, webp, svg ou png).',
                'imagens.*.max' => 'O tamanho máximo do arquivo é :max KB.'
            ]);
        }

        $project = Project::find($id);

        if($request->apagar_arquivo){
            File::delete('storage/arquivos/' . $project->user_id . '/' . $project->id . '/' . $project->arquivo);
            $project->arquivo = null;
        }

        $project->fill($request->only('titulo', 'descricao', 'tags', 'ferramentas'));
        $project->arquivo_publico = $request->input('arquivo_publico') ? 1 : 0;

        if ($request->file('imagem_capa') != null) {
            File::delete('storage/arquivos/' . $project->user_id . '/' . $project->id . '/' . $project->imagem_capa);
            $imgName = time() . '_' . $request->file('imagem_capa')->getClientOriginalName();
            $request->file('imagem_capa')->move(public_path('storage/arquivos/' . $project->user_id . '/' . $project->id), $imgName);
            $project->imagem_capa = $imgName;
        }

        if ($request->file('arquivo') != null) {
            File::delete('storage/arquivos/' . $project->user_id . '/' . $project->id . '/' . $project->arquivo);
            $arqName = time() . '_' . $request->file('arquivo')->getClientOriginalName();
            $request->file('arquivo')->move(public_path('storage/arquivos/' . $project->user_id . '/' . $project->id), $arqName);
            $project->arquivo = $arqName;
        }

        if ($request->file('imagens') != null) {
            foreach ($project->imagesProjects as $image) {
                File::delete('storage/arquivos/' . $project->user_id . '/' . $project->id . '/imgs/' . $image->name);
                $image->delete();
            }
            foreach ($request->imagens as $image) {
                $imgFileName = time() . '_' . $image->getClientOriginalName();
                ImagesProject::create([
                    'project_id' => $project->id,
                    'name' => $imgFileName,
                ]);
                $image->move(public_path('storage/arquivos/' . $project->user_id . '/' . $project->id . '/imgs'), $imgFileName);
            }
        }

        $project->save();

        return redirect()->route('project.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $project = Project::find($id);
        File::deleteDirectory(public_path('storage/arquivos/' . $project->user_id . '/' . $project->id));
        foreach ($project->imagesProjects as $image) {
            $image->delete();
        }
        $project->delete();

        return redirect()->route('user.perfil', auth()->user()->apelido);
    }
}
