<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calendário de Atividades</title>
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
            min-height: 42px;
            background: #ffffff;
            border-bottom: 1px solid #d9dde3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 0 14px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.12);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-left,
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .menu-icon {
            font-size: 22px;
            color: #333333;
            line-height: 1;
        }

        .brand {
            color: #0b477c;
            font-weight: 700;
            font-size: 15px;
        }

        .topbar-right {
            font-size: 13px;
        }

        .badge {
            background: #e9f2ff;
            color: #0b477c;
            padding: 6px 9px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 11px;
        }

        .topbar-link,
        .logout-button {
            border: none;
            background: transparent;
            color: #0b477c;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            padding: 0;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topbar-link:hover,
        .logout-button:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1100px;
            margin: 22px auto 40px;
            padding: 0 12px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #dfe4ea;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
            margin-bottom: 19px;
        }

        .filter-card {
            padding: 15px 20px;
        }

        .filter-form {
            display: flex;
            align-items: end;
            gap: 13px;
            flex-wrap: wrap;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .field label {
            font-size: 11px;
            font-weight: 700;
            color: #111827;
        }

        select,
        input,
        textarea {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 8px 12px;
            min-height: 34px;
            font-size: 14px;
            background: #ffffff;
            color: #111827;
        }

        textarea {
            height: 70px;
            resize: vertical;
            font-family: Arial, Helvetica, sans-serif;
        }

        select:focus,
        input:focus,
        textarea:focus {
            outline: 2px solid #bcd7f5;
            border-color: #0b477c;
        }

        .select-month {
            width: 130px;
        }

        .select-year {
            width: 90px;
        }

        .select-colaborador {
            width: 230px;
        }

        .btn {
            border: none;
            background: #0b477c;
            color: #ffffff;
            min-height: 38px;
            padding: 0 18px;
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

        .btn-secondary {
            background: #eef2f7;
            color: #0b477c;
        }

        .btn-secondary:hover {
            background: #dbe7f5;
        }

        .activity-form-card {
            padding: 17px 20px;
        }

        .activity-form-card h3 {
            margin: 0 0 14px;
            color: #0b477c;
            font-size: 16px;
        }

        .activity-form {
            display: grid;
            grid-template-columns: 170px 1fr 230px auto;
            gap: 12px;
            align-items: end;
        }

        .activity-form .field input,
        .activity-form .field select {
            width: 100%;
        }

        .description-row {
            grid-column: 1 / -1;
        }

        .description-row textarea {
            width: 100%;
        }

        .calendar-card {
            padding: 21px 22px;
        }

        .calendar-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0 0 20px 2px;
            font-size: 19px;
            font-weight: 700;
            color: #111827;
        }

        .calendar-icon {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            background: linear-gradient(#5bb7ff 0 35%, #f0dcff 35%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            border-radius: 4px;
            overflow: hidden;
            background: #ffffff;
        }

        .weekday {
            background: #eaeaea;
            padding: 9px 7px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            border-right: 2px solid #ffffff;
        }

        .weekday:last-child {
            border-right: none;
        }

        .day {
            min-height: 86px;
            background: #ffffff;
            padding: 10px 14px;
            border-right: 2px solid #ffffff;
            border-bottom: 2px solid #ffffff;
            position: relative;
            cursor: pointer;
        }

        .day:hover {
            background: #f8fbff;
        }

        .empty {
            background: #f7f8fa;
            cursor: default;
        }

        .day-number {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 6px;
            color: #111827;
        }

        .activity {
            background: #eaf3ff;
            border-left: 3px solid #0b477c;
            padding: 5px 7px;
            border-radius: 4px;
            margin-bottom: 5px;
            font-size: 11px;
            line-height: 1.3;
            position: relative;
            cursor: default;
        }

        .activity strong {
            display: block;
            color: #0b477c;
            padding-right: 16px;
        }

        .activity span {
            display: block;
            color: #4b5563;
        }

        .activity small {
            display: block;
            color: #6b7280;
            margin-top: 3px;
        }

        .delete-form {
            position: absolute;
            top: 2px;
            right: 4px;
        }

        .delete-btn {
            border: none;
            background: transparent;
            color: #991b1b;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
            padding: 0;
        }

        .delete-btn:hover {
            color: #7f1d1d;
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

        .empty-message {
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }

        @media (max-width: 900px) {
            .activity-form {
                grid-template-columns: 1fr;
            }

            .description-row {
                grid-column: auto;
            }

            .calendar-card {
                overflow-x: auto;
            }

            .calendar-grid {
                min-width: 780px;
            }
        }

        @media (max-width: 650px) {
            .topbar {
                align-items: flex-start;
                padding: 10px 14px;
            }

            .topbar-left,
            .topbar-right {
                width: 100%;
            }

            .container {
                margin: 15px auto 30px;
            }

            .filter-form {
                align-items: stretch;
            }

            .field,
            .select-month,
            .select-year,
            .select-colaborador,
            .btn,
            .btn-secondary {
                width: 100%;
            }
        }
    </style>
</head>
<body>

@php
    $usuarioLogado = auth()->user();
@endphp

<header class="topbar">
    <div class="topbar-left">
        <div class="menu-icon">≡</div>
        <div class="brand">Calendário de Atividades</div>
    </div>

    <div class="topbar-right">
        <span>
            Olá,
            <strong>{{ $usuarioLogado?->name ?? 'Visitante' }}</strong>
        </span>

        <span class="badge">
            {{ ucfirst($usuarioLogado?->perfil ?? 'Visitante') }}
        </span>

        @auth
            @if (method_exists($usuarioLogado, 'isAdmin') && $usuarioLogado->isAdmin())
                <a href="{{ route('seguranca.usuarios.index') }}" class="topbar-link">
                    Segurança
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">↪ Sair</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="topbar-link">Entrar</a>
        @endauth
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

    <section class="card filter-card">
        <form method="GET" action="{{ route('calendario.index') }}" class="filter-form">
            <div class="field">
                <label for="mes">Mês</label>
                <select name="mes" id="mes" class="select-month">
                    @foreach ($meses as $numero => $nome)
                        <option value="{{ $numero }}" @selected((int) $mes === (int) $numero)>
                            {{ $nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="ano">Ano</label>
                <select name="ano" id="ano" class="select-year">
                    @foreach ($anos as $anoOpcao)
                        <option value="{{ $anoOpcao }}" @selected((int) $ano === (int) $anoOpcao)>
                            {{ $anoOpcao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="colaborador">Colaborador</label>
                <select name="colaborador" id="colaborador" class="select-colaborador">
                    <option value="">Todos</option>

                    @foreach ($colaboradores as $colaborador)
                        <option
                            value="{{ $colaborador->id }}"
                            @selected((string) $colaboradorSelecionado === (string) $colaborador->id)
                        >
                            {{ $colaborador->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn">Filtrar</button>

            <a href="{{ route('calendario.index') }}" class="btn btn-secondary">
                Limpar
            </a>
        </form>
    </section>

    <section class="card activity-form-card">
        <h3>Nova atividade</h3>

        @if ($colaboradores->isEmpty())
            <p class="empty-message">
                Cadastre colaboradores no banco para conseguir criar atividades.
            </p>
        @else
            <form method="POST" action="{{ route('atividades.store') }}" class="activity-form">
                @csrf

                <div class="field">
                    <label for="data">Data</label>
                    <input
                        type="date"
                        id="data"
                        name="data"
                        value="{{ old('data', $dataBase->format('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="titulo">Título da atividade</label>
                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        value="{{ old('titulo') }}"
                        placeholder="Ex: Reunião, instalação, visita..."
                        maxlength="255"
                        required
                    >
                </div>

                <div class="field">
                    <label for="colaborador_id">Colaborador</label>
                    <select name="colaborador_id" id="colaborador_id" required>
                        <option value="">Selecione</option>

                        @foreach ($colaboradores as $colaborador)
                            <option
                                value="{{ $colaborador->id }}"
                                @selected((string) old('colaborador_id', $colaboradorSelecionado) === (string) $colaborador->id)
                            >
                                {{ $colaborador->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn">Cadastrar</button>

                <div class="field description-row">
                    <label for="descricao">Descrição</label>
                    <textarea
                        id="descricao"
                        name="descricao"
                        placeholder="Observações da atividade..."
                    >{{ old('descricao') }}</textarea>
                </div>
            </form>
        @endif
    </section>

    <section class="card calendar-card">
        <h2 class="calendar-title">
            <span class="calendar-icon">▦</span>
            {{ $meses[$mes] }} {{ $ano }}
        </h2>

        <div class="calendar-grid">
            <div class="weekday">SEG</div>
            <div class="weekday">TER</div>
            <div class="weekday">QUA</div>
            <div class="weekday">QUI</div>
            <div class="weekday">SEX</div>
            <div class="weekday">SÁB</div>
            <div class="weekday">DOM</div>

            @for ($i = 1; $i < $primeiroDiaSemana; $i++)
                <div class="day empty"></div>
            @endfor

            @for ($dia = 1; $dia <= $diasNoMes; $dia++)
                @php
                    $dataDia = $dataBase->copy()->day($dia)->format('Y-m-d');
                    $atividadesDoDia = $atividadesPorDia->get($dia, collect());
                @endphp

                <div class="day" data-date="{{ $dataDia }}" title="Clique para selecionar esta data">
                    <div class="day-number">{{ $dia }}</div>

                    @foreach ($atividadesDoDia as $atividade)
                        <div class="activity" onclick="event.stopPropagation()">
                            <strong>{{ $atividade->titulo }}</strong>

                            <span>
                                {{ $atividade->colaborador->nome ?? 'Sem colaborador' }}
                            </span>

                            @if (!empty($atividade->descricao))
                                <small>{{ $atividade->descricao }}</small>
                            @endif

                            <form
                                method="POST"
                                action="{{ route('atividades.destroy', $atividade) }}"
                                class="delete-form"
                                onsubmit="return confirm('Deseja excluir esta atividade?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" title="Excluir atividade">×</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endfor

            @php
                $totalCelulasUsadas = ($primeiroDiaSemana - 1) + $diasNoMes;
                $celulasRestantes = (7 - ($totalCelulasUsadas % 7)) % 7;
            @endphp

            @for ($i = 0; $i < $celulasRestantes; $i++)
                <div class="day empty"></div>
            @endfor
        </div>
    </section>

</main>

<script>
    document.querySelectorAll('.day[data-date]').forEach(function (day) {
        day.addEventListener('click', function () {
            const inputData = document.getElementById('data');

            if (!inputData) {
                return;
            }

            inputData.value = this.dataset.date;

            inputData.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            inputData.focus();
        });
    });
</script>

</body>
</html>