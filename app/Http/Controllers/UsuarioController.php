<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $usuarios = User::query()
            ->when($busca, function ($query) use ($busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('name', 'like', "%{$busca}%")
                        ->orWhere('email', 'like', "%{$busca}%")
                        ->orWhere('perfil', 'like', "%{$busca}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('seguranca.usuarios.index', compact('usuarios', 'busca'));
    }

    public function create()
    {
        return view('seguranca.usuarios.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'perfil' => ['required', Rule::in(['admin', 'usuario'])],
            'ativo' => ['nullable', 'boolean'],
        ]);

        User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password']),
            'perfil' => $dados['perfil'],
            'ativo' => $request->boolean('ativo'),
        ]);

        return redirect()
            ->route('seguranca.usuarios.index')
            ->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $user)
    {
        return view('seguranca.usuarios.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'perfil' => ['required', Rule::in(['admin', 'usuario'])],
            'ativo' => ['nullable', 'boolean'],
        ]);

        $novoAtivo = $request->boolean('ativo');

        if ($this->isUltimoAdminAtivo($user) && ($dados['perfil'] !== 'admin' || !$novoAtivo)) {
            return back()
                ->withErrors([
                    'usuario' => 'Não é permitido remover ou desativar o último administrador ativo.',
                ])
                ->withInput();
        }

        $user->update([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'perfil' => $dados['perfil'],
            'ativo' => $novoAtivo,
        ]);

        return redirect()
            ->route('seguranca.usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    public function updatePassword(Request $request, User $user)
    {
        $dados = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($dados['password']),
        ]);

        return redirect()
            ->route('seguranca.usuarios.edit', $user)
            ->with('success', 'Senha alterada com sucesso.');
    }

    public function toggleStatus(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors([
                'usuario' => 'Você não pode desativar o próprio usuário.',
            ]);
        }

        if ($this->isUltimoAdminAtivo($user)) {
            return back()->withErrors([
                'usuario' => 'Não é permitido desativar o último administrador ativo.',
            ]);
        }

        $user->update([
            'ativo' => !$user->ativo,
        ]);

        return back()->with('success', 'Status do usuário alterado com sucesso.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors([
                'usuario' => 'Você não pode excluir o próprio usuário.',
            ]);
        }

        if ($this->isUltimoAdminAtivo($user)) {
            return back()->withErrors([
                'usuario' => 'Não é permitido excluir o último administrador ativo.',
            ]);
        }

        $user->delete();

        return redirect()
            ->route('seguranca.usuarios.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }

    private function isUltimoAdminAtivo(User $user): bool
    {
        if (!$user->isAdmin() || !$user->isAtivo()) {
            return false;
        }

        return User::where('perfil', 'admin')
            ->where('ativo', true)
            ->count() <= 1;
    }
}