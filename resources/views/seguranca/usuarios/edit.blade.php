@extends('layouts.seguranca')

@section('title', 'Editar Usuário - Segurança')

@section('content')
    <h1 class="page-title">Editar Usuário</h1>

    <section class="card">
        <form method="POST" action="{{ route('seguranca.usuarios.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field">
                    <label for="name">Nome</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="perfil">Perfil</label>
                    <select id="perfil" name="perfil" required>
                        <option value="usuario" @selected(old('perfil', $user->perfil) === 'usuario')>
                            Usuário
                        </option>

                        <option value="admin" @selected(old('perfil', $user->perfil) === 'admin')>
                            Administrador
                        </option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="ativo" value="0">

            <label class="checkbox-line">
                <input
                    type="checkbox"
                    name="ativo"
                    value="1"
                    @checked(old('ativo', $user->ativo) == 1)
                >
                Usuário ativo
            </label>

            <button type="submit" class="btn">Salvar alterações</button>

            <a href="{{ route('seguranca.usuarios.index') }}" class="btn btn-muted">
                Voltar
            </a>
        </form>
    </section>

    <section class="card">
        <h2 style="font-size: 17px; color: #0b477c; margin-top: 0;">
            Alterar senha
        </h2>

        <form method="POST" action="{{ route('seguranca.usuarios.password', $user) }}">
            @csrf
            @method('PATCH')

            <div class="form-grid">
                <div class="field">
                    <label for="password">Nova senha</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                    >
                    <span class="small-text">Mínimo de 8 caracteres.</span>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirmar nova senha</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-warning">
                Alterar senha
            </button>
        </form>
    </section>
@endsection