<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Segurança')</title>
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
            font-size: 14px;
        }

        .topbar {
            height: 42px;
            background: #ffffff;
            border-bottom: 1px solid #d9dde3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 14px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        }

        .topbar-left,
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand {
            color: #0b477c;
            font-weight: 700;
            font-size: 15px;
        }

        .nav-link {
            color: #0b477c;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .badge {
            background: #e9f2ff;
            color: #0b477c;
            padding: 6px 9px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 11px;
        }

        .logout-button {
            border: none;
            background: transparent;
            color: #0b477c;
            cursor: pointer;
            font-size: 13px;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 22px auto 40px;
            padding: 0 12px;
        }

        .page-title {
            font-size: 22px;
            margin: 0 0 15px;
            color: #0b477c;
        }

        .card {
            background: #ffffff;
            border: 1px solid #dfe4ea;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            padding: 18px;
            margin-bottom: 18px;
        }

        .actions-bar {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-bottom: 13px;
        }

        label {
            font-size: 12px;
            font-weight: 700;
        }

        input,
        select {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 8px 12px;
            min-height: 36px;
            font-size: 14px;
            background: #ffffff;
        }

        input:focus,
        select:focus {
            outline: 2px solid #bcd7f5;
            border-color: #0b477c;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .checkbox-line {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 10px 0 16px;
        }

        .checkbox-line input {
            min-height: auto;
        }

        .btn {
            border: none;
            background: #0b477c;
            color: #ffffff;
            min-height: 36px;
            padding: 8px 16px;
            border-radius: 18px;
            cursor: pointer;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .btn:hover {
            background: #083961;
        }

        .btn-muted {
            background: #eef2f7;
            color: #0b477c;
        }

        .btn-muted:hover {
            background: #dbe7f5;
        }

        .btn-danger {
            background: #991b1b;
        }

        .btn-danger:hover {
            background: #7f1d1d;
        }

        .btn-warning {
            background: #b45309;
        }

        .btn-warning:hover {
            background: #92400e;
        }

        .inline-form {
            display: inline;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
        }

        th {
            text-align: left;
            background: #eaeaea;
            color: #111827;
            font-size: 12px;
            padding: 10px;
        }

        td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px;
            vertical-align: middle;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
            padding: 5px 8px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 12px;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
            padding: 5px 8px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 12px;
        }

        .perfil {
            background: #e9f2ff;
            color: #0b477c;
            padding: 5px 8px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 12px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .errors {
            margin: 0;
            padding-left: 18px;
        }

        .small-text {
            color: #6b7280;
            font-size: 12px;
        }

        @media (max-width: 800px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                height: auto;
                min-height: 42px;
                flex-wrap: wrap;
                padding: 8px 14px;
            }
        }
    </style>
</head>
<body>

<header class="topbar">
    <div class="topbar-left">
        <div class="brand">Segurança do Sistema</div>
        <a href="{{ route('calendario.index') }}" class="nav-link">Calendário</a>
        <a href="{{ route('seguranca.usuarios.index') }}" class="nav-link">Usuários</a>
    </div>

    <div class="topbar-right">
        <span>Olá, <strong>{{ auth()->user()->name }}</strong></span>
        <span class="badge">{{ ucfirst(auth()->user()->perfil) }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">↪ Sair</button>
        </form>
    </div>
</header>

<main class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <ul class="errors">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>