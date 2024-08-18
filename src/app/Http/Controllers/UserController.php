<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\throwException;

class UserController extends Controller
{

    public function showPerfil(string $apelido)
    {

        $user = User::where('apelido', $apelido)->first();
        if ($user == null) {
            return view('home');
        }

        $projects = Project::where('user_id', $user->id)->get();
        return view('user.perfil', compact('user', 'projects'));
    }

    /*
     * atualizar disponibilidade
     * */
    public function updateDisponibility(int $id)
    {

        $user = User::find($id);

        if(auth()->id() != $id){
            return redirect()->route('home');
        }

        $disponivel = $user->disponivel;

        $user->disponivel = !$disponivel;

        $user->save();
        return redirect()->route('user.perfil', $user->apelido);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();

        $fileName = null;

        if ($request->file('foto') != null) {
            $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('storage/fotos'), $fileName);
        }

        User::create([
            'nome' => $request->nome,
            'apelido' => $request->apelido,
            'email' => $request->email,
            'password' => $request->password,
            'numero_telefone' => $request->numero_telefone,
            'foto' => $fileName
        ]);

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
            return view('home');
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
            $request->file('foto')->move(public_path('storage/fotos/' . $user->apelido), $fileName);
            if($user->foto != null){
                File::delete(public_path('storage/fotos/'. $user->apelido . '/' . $user->foto));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
