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
        $agendamentos = Agendamento::with(['sala','disciplina','intervaloDeHora'])->paginate(7);
        return view('agendamentos.listar-agendamento', compact('agendamentos'));
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
        if($this->verificarDisponibilidadeDeSalaEmUmHorariodeUmDia($request)){
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
        } else {
            return redirect()->route('agendamentos.create')->with('error', 'Já há uma prova agendada para as '.$request->hora_inicial.' - '.$request->hora_final.' do dia '.$request->data.'. Tente outro horário.');
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
    public function edit($id)
    {
        // $agendamento = DB::table('agendamentos')->with(['sala','disciplina','intervaloDeHora'])->where('id', $id)->first();
        $agendamentos = Agendamento::with(['sala', 'intervaloDeHora', 'disciplina'])->findOrFail($id);
        $salaSelecionada = $agendamentos->sala ?? null;
        $intervaloDeHora = $agendamentos->intervaloDeHora ?? null;
        $dataSelecionada = $agendamentos->data ?? null;
        return View('agendamentos.editar-agendamento', compact(['agendamentos','salaSelecionada','intervaloDeHora','dataSelecionada']));
    }

    /**
     * Atualiza uma turma no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::find($id);
        $agendamento->sala_id = $request->input('sala_id');//talvez não seja input
        $agendamento->intervalo_de_hora_de_agendamento_id = $request->input('intervalo_de_hora_de_agendamento_id');//talvez não seja input
        $agendamento->disciplina_id = $request->input('disciplina_id');//talvez não seja input
        $agendamento->data = $request->input('data');
        $agendamento->save();
        return redirect()->route('agendamentos.index', $id)->with('success', 'Agendamento atualizado com successo');

    }
    // public function update(Request $request, $id)
    // {
    //     try {
    //         $agendamento = Agendamento::findOrFail($id);  // Recupera o agendamento pelo ID
    //         $agendamento->update($request->only([
    //             'disciplina_id', 'data', 'intervalo_de_hora_de_agendamento_id', 'sala_id'
    //         ]));

    //         return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso!');
    //     } catch (\Exception $e) {
    //         return redirect()->route('agendamentos.index')->with('error', 'Falha ao atualizar o agendamento: ' . $e->getMessage());
    //     }
    // }

    /**
     * Remove uma turma do banco de dados.
     */
    public function destroy( $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();
        // $sala = Sala::destroy($id);
        return redirect()->route('agendamentos.index', $id)->with('danger', 'Agendamento removido com successo');
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

    private function verificarDisponibilidadeDeSalaEmUmHorariodeUmDia(Request $request){
        $resultado = DB::select('SELECT COUNT(*) as contagem_agendamento_repetido
            FROM agendamentos
            WHERE sala_id = ? and intervalo_de_hora_de_agendamento_id = ? and data = ?;',
        [$request->sala_id, $request->intervalo_de_hora_de_agendamento_id, $request->data]);

        $contagem = $resultado[0]->contagem_agendamento_repetido ?? 0;
        dump($contagem);
        if($contagem == 0){
            return true;
        }

        return false;

    }
}
