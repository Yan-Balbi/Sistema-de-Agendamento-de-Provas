<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DisciplinaController extends Controller
{
    public function listar(Request $request)
    {
        $query = Disciplina::query();

        if ($request->has('buscar')) {
            $query->where('nome', 'LIKE', '%' . $request->input('buscar') . '%');
        }

        $disciplinas = $query->paginate(7);

        return view('disciplinas.disciplina-listar', compact('disciplinas'));
    }


    public function create(){
        return view("disciplinas.disciplina-form");
    }

    public function store(Request $request)
    {
        //$disciplina = $request->all();      

        //dd($request->input('nome'));

        Disciplina::create([
            "nome"=>$request->input('nome')
        ]);
        return redirect()->route('disciplina.create')->with('success','Disciplina adicionado!');
    }

    public function destroy(string $id)
    {
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();
        
        return redirect()->route('disciplina.listar', $id)->with('success', 'Disciplina removida com successo');
    }

    public function update(Request $request, string $id)
    {
        $disciplina = Disciplina::find($id);
        $disciplina->nome = $request->input('name');
        $disciplina->save();
        return redirect()->route('disciplina.edit', $id)->with('success', 'Disciplina atualizada com successo');
    }

    public function edit(string $id)
    {
        $disciplina = DB::table('disciplinas')->where('id', $id)->first();
       
        return view('disciplinas.disciplina-edit', compact('disciplina'));
    }    
}
