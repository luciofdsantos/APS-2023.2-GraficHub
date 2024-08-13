<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(UserRequest $request)
    {
        $request->validated();

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('auth.index')->with('sucess', 'logado com sucesso!');
        }

        return redirect()->route('auth.index')->withErrors(['error' => 'Email ou senha invalido.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.index');
    }
}
