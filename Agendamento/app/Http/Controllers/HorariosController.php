<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\IntervaloDeHoraDeAgendamento;
use Carbon\Carbon;

class HorariosController extends Controller
{
    public function index(Request $request)
    {
        $dataInicial = $request->input('data_inicial', Carbon::today()->toDateString());
        $dataInicial = Carbon::parse($dataInicial)->startOfWeek();
        $dataFinal = $dataInicial->copy()->endOfWeek();

        $agendamentos = Agendamento::whereBetween('data', [$dataInicial, $dataFinal])->get();

        // Buscar os horários disponíveis do banco de dados
        $horarios = IntervaloDeHoraDeAgendamento::all(['hora_inicial', 'hora_final'])->toArray();

        return view('index', compact('agendamentos', 'dataInicial', 'horarios'));
    }
}