<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\IntervaloDeHoraDeAgendamento;
use App\Models\Turma;
use App\Models\Curso;
use App\Models\Professor;
use App\Models\Sala;
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
        $agendamento = $request->all();
        if($request->disciplina_id and $request->data and $request->sala_id and $request->intervalo_de_hora_de_agendamento_id){
            try {
                $agendamento = $request->all();

                Agendamento::create($agendamento);

                return redirect()->route('agendamentos.create')->with('success', 'Sala adicionada!');
            } catch (\Exception $e) {
                return redirect()->route('agendamentos.create')->with('error', 'Falha ao cadastrar sala. Erro: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('agendamentos.create')->with('warning', 'Preencha todos os campos antes de agendar a prova!');
        }
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

    public function buscarTodosOsCursos(){
        $cursos = Curso::all();
        return response()->json($cursos);
    }

    public function buscarTurmasDeUmCurso(Request $request){

        $turmasDeUmCurso = [];

        if($request->cursoId){
            $turmasDeUmCurso = DB::select('SELECT * FROM turmas WHERE curso_id = ?', [$request->cursoId]);
        }

        return response()->json($turmasDeUmCurso);
    }

    public function buscarTodosOsProfessoresDeUmaTurma(Request $request){

        $professores = [];

        if($request->turmaId){
            $professores = Professor::all();
        }
        return response()->json($professores);
    }

    public function buscarDisciplinasDeUmaTurmaDeUmCursoEDeUmProfessor(Request $request){

        $disciplinas = [];
        if($request->professorId and $request->turmaId){
            $disciplinas = DB::select('SELECT d.* FROM disciplinas d
            JOIN turma_has_disciplinas thd
            ON d.id = thd.disciplina_id
            JOIN turmas t
            ON thd.turma_id = t.id
            JOIN cursos c
            ON t.curso_id = c.id
            JOIN professor_has_disciplinas phd
            ON d.id = phd.disciplina_id
            JOIN professors p
            ON phd.professor_id = p.id
            WHERE p.id = ? and t.id = ?;', [$request->professorId, $request->turmaId]);
        }
        return response()->json($disciplinas);
    }

    public function buscarSalas(){
        $salas = [];

        $salas = Sala::all();

        return response()->json($salas);
    }

    public function buscarHorarios(){
        $horarios = [];

        $horarios = IntervaloDeHoraDeAgendamento::all();

        return response()->json($horarios);
    }
}
