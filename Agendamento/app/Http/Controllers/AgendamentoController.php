<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{
    /**
     * Exibe a listagem de turmas.
     */
    public function index()
    {
        $agendamento = Agendamento::paginate(7);
        return view('agendamentos.listar-agendamento', compact('agendamento'));
    }

    /**
     * Mostra o formulário de criação de turma.
     */
    public function create()
    {
        return View('agendamentos.cadastrar-agendamento');
    }

    /**
     * Salva uma nova turma no banco de dados.
     */
    public function store(Request $request)
    {

    }

    /**
     * Exibe os detalhes de uma turma específica.
     */
    public function show(Turma $turma)
    {

    }

    /**
     * Mostra o formulário de edição de uma turma.
     */
    public function edit(Turma $turma)
    {

    }

    /**
     * Atualiza uma turma no banco de dados.
     */
    public function update(Request $request, Turma $turma)
    {


    }

    /**
     * Remove uma turma do banco de dados.
     */
    public function destroy(Turma $turma)
    {

    }
}
