<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'não pode ficar vazio',
            'email.email' => 'ensira um email valido',
            'password.required' => 'não pode ficar vazio',
        ]);


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
