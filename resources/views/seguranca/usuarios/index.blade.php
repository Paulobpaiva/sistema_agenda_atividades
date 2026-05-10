@extends('layouts.seguranca')

@section('title', 'Usuários - Segurança')

@section('content')
    <h1 class="page-title">Gerenciamento de Usuários</h1>

    <section class="card">
        <div class="actions-bar">
            <form method="GET" action="{{ route('seguranca.usuarios.index') }}" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <div class="field" style="margin-bottom: 0;">
                    <label for="busca">Buscar usuário</label>
                    <input
                        type="text"
                        id="busca"
                        name="busca"
                        value="{{ $busca }}"
                        placeholder="Nome, e-mail ou perfil"
                        style="width: 280px;"
                    >
                </div>

                <button type="submit" class="btn">Buscar</button>

                <a href="{{ route('seguranca.usuarios.index') }}" class="btn btn-muted">
                    Limpar
                </a>
            </form>

            <a href="{{ route('seguranca.usuarios.create') }}" class="btn">
                Novo usuário
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfil</th>
                        <th>Status</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>
                                <strong>{{ $usuario->name }}</strong>

                                @if (auth()->id() === $usuario->id)
                                    <div class="small-text">Seu usuário</div>
                                @endif
                            </td>

                            <td>{{ $usuario->email }}</td>

                            <td>
                                <span class="perfil">
                                    {{ ucfirst($usuario->perfil) }}
                                </span>
                            </td>

                            <td>
                                @if ($usuario->ativo)
                                    <span class="status-active">Ativo</span>
                                @else
                                    <span class="status-inactive">Inativo</span>
                                @endif
                            </td>

                            <td>
                                {{ $usuario->created_at?->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                <a href="{{ route('seguranca.usuarios.edit', $usuario) }}" class="btn btn-muted">
                                    Editar
                                </a>

                                @if (auth()->id() !== $usuario->id)
                                    <form
                                        method="POST"
                                        action="{{ route('seguranca.usuarios.status', $usuario) }}"
                                        class="inline-form"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-warning">
                                            {{ $usuario->ativo ? 'Desativar' : 'Ativar' }}
                                        </button>
                                    </form>

                                    <form
                                        method="POST"
                                        action="{{ route('seguranca.usuarios.destroy', $usuario) }}"
                                        class="inline-form"
                                        onsubmit="return confirm('Deseja realmente excluir este usuário?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Excluir
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                Nenhum usuário encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 15px;">
            {{ $usuarios->links() }}
        </div>
    </section>
@endsection