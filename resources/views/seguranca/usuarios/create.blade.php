@extends('layouts.seguranca')

@section('title', 'Novo Usuário - Segurança')

@section('content')
    <h1 class="page-title">Novo Usuário</h1>

    <section class="card">
        <form method="POST" action="{{ route('seguranca.usuarios.store') }}">
            @csrf

            <div class="form-grid">
                <div class="field">
                    <label for="name">Nome</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="password">Senha</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                    >
                    <span class="small-text">Mínimo de 8 caracteres.</span>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirmar senha</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                    >
                </div>

                <div class="field">
                    <label for="perfil">Perfil</label>
                    <select id="perfil" name="perfil" required>
                        <option value="usuario" @selected(old('perfil') === 'usuario')>Usuário</option>
                        <option value="admin" @selected(old('perfil') === 'admin')>Administrador</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="ativo" value="0">

            <label class="checkbox-line">
                <input
                    type="checkbox"
                    name="ativo"
                    value="1"
                    @checked(old('ativo', '1') == '1')
                >
                Usuário ativo
            </label>

            <button type="submit" class="btn">Salvar usuário</button>

            <a href="{{ route('seguranca.usuarios.index') }}" class="btn btn-muted">
                Voltar
            </a>
        </form>
    </section>
@endsection