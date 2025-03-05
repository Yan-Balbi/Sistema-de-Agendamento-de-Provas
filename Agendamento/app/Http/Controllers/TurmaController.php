<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use App\Models\Professor;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    /**
     * Exibe a listagem de turmas.
     */
    public function index()
    {
        $turmas = Turma::with('curso', 'professors', 'disciplinas')->get();
        return view('turmas.index', compact('turmas'));
    }

    /**
     * Mostra o formulário de criação de turma.
     */
    public function create()
    {
        $cursos = Curso::all();
        $professors = Professor::all();
        $disciplinas = Disciplina::all();
        return view('turmas.create', compact('cursos', 'professors', 'disciplinas'));
    }

    /**
     * Salva uma nova turma no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'professors' => 'required|array',
            'professors.*' => 'exists:professors,id',
            'disciplinas' => 'required|array',
            'disciplinas.*' => 'exists:disciplinas,id',
        ]);

        $turma = Turma::create([
            'nome' => $request->nome,
            'curso_id' => $request->curso_id,
        ]);

        $turma->professors()->attach($request->professors);
        $turma->disciplinas()->attach($request->disciplinas);

        return redirect()->route('turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma turma específica.
     */
    public function show(Turma $turma)
    {
        return view('turmas.show', compact('turma'));
    }

    /**
     * Mostra o formulário de edição de uma turma.
     */
    public function edit(Turma $turma)
    {
        $cursos = Curso::all();
        $professors = Professor::all();
        $disciplinas = Disciplina::all();
        return view('turmas.edit', compact('turma', 'cursos', 'professors', 'disciplinas'));
    }

    /**
     * Atualiza uma turma no banco de dados.
     */
    public function update(Request $request, Turma $turma)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'professors' => 'required|array',
            'professors.*' => 'exists:professors,id',
            'disciplinas' => 'required|array',
            'disciplinas.*' => 'exists:disciplinas,id',
        ]);

        $turma->update([
            'nome' => $request->nome,
            'curso_id' => $request->curso_id,
        ]);

        $turma->professors()->sync($request->professors);
        $turma->disciplinas()->sync($request->disciplinas);

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    /**
     * Remove uma turma do banco de dados.
     */
    public function destroy(Turma $turma)
    {
        $turma->professors()->detach();
        $turma->disciplinas()->detach();
        $turma->delete();

        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
}
