<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Colaborador;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioAtividadesController extends Controller
{
    public function index(Request $request)
    {
        $mes = (int) $request->input('mes', now()->month);
        $ano = (int) $request->input('ano', now()->year);
        $colaboradorSelecionado = $request->input('colaborador');

        $dataBase = Carbon::create($ano, $mes, 1);
        $inicioMes = $dataBase->copy()->startOfMonth();
        $fimMes = $dataBase->copy()->endOfMonth();

        $primeiroDiaSemana = $inicioMes->dayOfWeekIso;
        $diasNoMes = $inicioMes->daysInMonth;

        $query = Atividade::with('colaborador')
            ->whereBetween('data', [
                $inicioMes->toDateString(),
                $fimMes->toDateString(),
            ]);

        if (!empty($colaboradorSelecionado)) {
            $query->where('colaborador_id', $colaboradorSelecionado);
        }

        $atividadesPorDia = $query
            ->orderBy('data')
            ->get()
            ->groupBy(fn ($atividade) => $atividade->data->day);

        $colaboradores = Colaborador::orderBy('nome')->get();

        $meses = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];

        $anos = range(now()->year - 3, now()->year + 3);

        return view('calendario.index', compact(
            'mes',
            'ano',
            'meses',
            'anos',
            'dataBase',
            'diasNoMes',
            'primeiroDiaSemana',
            'colaboradores',
            'colaboradorSelecionado',
            'atividadesPorDia'
        ));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'colaborador_id' => ['required', 'exists:colaboradores,id'],
            'data' => ['required', 'date'],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
        ]);

        Atividade::create($dados);

        $data = Carbon::parse($dados['data']);

        return redirect()
            ->route('calendario.index', [
                'mes' => $data->month,
                'ano' => $data->year,
                'colaborador' => $dados['colaborador_id'],
            ])
            ->with('success', 'Atividade cadastrada com sucesso.');
    }

    public function destroy(Atividade $atividade)
    {
        $atividade->delete();

        return back()->with('success', 'Atividade excluída com sucesso.');
    }
}