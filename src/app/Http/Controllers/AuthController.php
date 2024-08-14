<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('sucess', 'logado com sucesso!');
        }

        return redirect()->route('auth.loginForm')->withErrors(['error' => 'Credenciais Inválidas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.loginForm');
    }
}
