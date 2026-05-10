<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Calendário de Atividades</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f5f7;
            color: #111827;
        }

        .topbar {
            height: 39px;
            background: #ffffff;
            border-bottom: 1px solid #d9dde3;
            display: flex;
            align-items: center;
            padding: 0 14px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        }

        .brand {
            color: #0b477c;
            font-weight: 700;
            font-size: 15px;
            margin-left: 14px;
        }

        .menu-icon {
            font-size: 22px;
            color: #333;
        }

        .page {
            min-height: calc(100vh - 39px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 390px;
            background: #ffffff;
            border: 1px solid #dfe4ea;
            border-radius: 6px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.12);
            padding: 25px;
        }

        h1 {
            margin: 0 0 6px;
            font-size: 22px;
            color: #0b477c;
        }

        .subtitle {
            margin: 0 0 20px;
            color: #6b7280;
            font-size: 14px;
        }

        .field {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            height: 38px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 14px;
        }

        input:focus {
            outline: 2px solid #bcd7f5;
            border-color: #0b477c;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .remember input {
            width: auto;
            height: auto;
        }

        .btn {
            width: 100%;
            height: 39px;
            border: none;
            background: #0b477c;
            color: #ffffff;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 700;
        }

        .btn:hover {
            background: #083961;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 10px 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<header class="topbar">
    <div class="menu-icon">≡</div>
    <div class="brand">Calendário de Atividades</div>
</header>

<main class="page">
    <section class="login-card">
        <h1>Entrar no sistema</h1>
        <p class="subtitle">Informe seu e-mail e senha para acessar.</p>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="field">
                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
            </div>

            <label class="remember">
                <input type="checkbox" name="remember" value="1">
                Lembrar acesso
            </label>

            <button type="submit" class="btn">Entrar</button>
        </form>
    </section>
</main>

</body>
</html>