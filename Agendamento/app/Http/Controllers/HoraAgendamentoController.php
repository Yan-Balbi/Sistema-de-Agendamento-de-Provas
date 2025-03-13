<?php

namespace App\Http\Controllers;

use App\Models\IntervaloDeHoraDeAgendamento;
use Illuminate\Http\Request;

class HoraAgendamentoController extends Controller
{
    /**
     * Lista todos os horários de agendamento.
     */
    public function index()
    {
        $horarios = IntervaloDeHoraDeAgendamento::all();
        return view('hora-agendamento.index', compact('horarios'));
    }

    /**
     * Busca um horário de agendamento específico pelo ID.
     */
    public function show($id)
    {
        $horario = IntervaloDeHoraDeAgendamento::findOrFail($id);
        return response()->json($horario);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hora-agendamento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'hora_inicial' => 'required|date_format:H:i',
            'hora_final' => 'required|date_format:H:i|after:hora_inicial',
        ]);

        IntervaloDeHoraDeAgendamento::create($request->all());

        return redirect()->route('hora-agendamento.index')->with('success', 'Horário de agendamento criado com sucesso!');
    }

    /**
     * Mostra o formulário de edição de um horário de agendamento.
     */
    public function edit($id)
    {
        $horario = IntervaloDeHoraDeAgendamento::findOrFail($id);
        return view('hora-agendamento.edit', compact('horario'));
    }

    /**
     * Atualiza um horário de agendamento no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hora_inicial' => 'required|date_format:H:i',
            'hora_final' => 'required|date_format:H:i|after:hora_inicial',
        ]);

        $horario = IntervaloDeHoraDeAgendamento::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('hora-agendamento.index')->with('success', 'Horário de agendamento atualizado com sucesso!');
    }

    /**
     * Remove um horário de agendamento do banco de dados.
     */
    public function destroy($id)
    {
        $horario = IntervaloDeHoraDeAgendamento::findOrFail($id);
        $horario->delete();

        return redirect()->route('hora-agendamento.index')->with('success', 'Horário de agendamento removido com sucesso!');
    }
}
