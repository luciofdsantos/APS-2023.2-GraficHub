<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function showPerfil(string $apelido)
    {
        $user = User::where('apelido', $apelido)->first();
        if ($user == null) {
            abort(404);
        }

        $projects = Project::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(6);
        $seguidores = $user->seguidores()->orderBy('created_at', 'desc')->paginate(2);
        $seguindo = $user->seguindo()->orderBy('created_at', 'desc')->paginate(2);
        return view('user.perfil', compact('user', 'projects', 'seguidores', 'seguindo'));
    }

    /**
     * atualizar disponibilidade
     * @param int $id
     */
    public function updateDisponibility(int $id)
    {

        $user = User::find($id);

        if (auth()->id() != $id) {
            abort(403);
        }

        $disponivel = $user->disponivel;

        $user->disponivel = !$disponivel;

        $user->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();

        $user = User::create([
            'nome' => $request->nome,
            'apelido' => $request->apelido,
            'email' => $request->email,
            'password' => $request->password,
            'numero_telefone' => $request->numero_telefone,
        ]);

        $fileName = null;

        if ($request->file('foto') != null) {
            $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('storage/arquivos/' . $user->id), $fileName);
        }

        $user->foto = $fileName;
        $user->save();

        return redirect()->route('auth.loginForm');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $apelido)
    {
        $user = User::where('apelido', $apelido)->first()->toArray();
        if ($user == null || $user['id'] != auth()->id()) {
            abort(403);
        }
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $apelido)
    {
        $user = User::where('apelido', $apelido)->first();

        $request->validated();

        if ($request->file('foto') != null) {
            $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('storage/arquivos/' . $user->id), $fileName);
            if ($user->foto != null) {
                File::delete(public_path('storage/arquivos/' . $user->id . '/' . $user->foto));
            }
            $user->foto = $fileName;
        }

        $user->fill($request->only('nome', 'apelido', 'email', 'numero_telefone'));
        if ($request->password != null) {
            $user->fill($request->only('password'));
        }

        $user->save();
        return redirect()->route('user.perfil', $user->apelido);
    }

    public function follow(int $user_id)
    {
        if (auth()->check() && auth()->id() != $user_id) {
            auth()->user()->seguindo()->attach($user_id);
        } else {
            return redirect()->route('auth.loginForm');
        }
        return redirect()->back();
    }

    public function seguindo(string $apelido)
    {
        $user = User::where('apelido', $apelido)->first();
        if ($user == null) {
            abort(404);
        }
        $followers = $user->seguindo()->orderBy('created_at', 'desc')->paginate(2);
        return view('user.showFollowers', compact('user', 'followers'));
    }

    public function unfollow(int $user_id)
    {
        if (auth()->check() && auth()->id() != $user_id) {
            auth()->user()->seguindo()->detach($user_id);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function seguidores(string $apelido)
    {
        $user = User::where('apelido', $apelido)->first();
        if ($user == null) {
            abort(404);
        }
        $followers = $user->seguidores()->orderBy('created_at', 'desc')->paginate(2);
        return view('user.showFollowers', compact('user', 'followers'));
    }
}
