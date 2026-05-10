<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $lembrar = $request->boolean('remember');

        $credenciais = [
            'email' => $dados['email'],
            'password' => $dados['password'],
            'ativo' => true,
        ];

        if (Auth::attempt($credenciais, $lembrar)) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('calendario.index'))
                ->with('success', 'Login realizado com sucesso.');
        }

        return back()
            ->withErrors([
                'email' => 'E-mail, senha inválidos ou usuário desativado.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}