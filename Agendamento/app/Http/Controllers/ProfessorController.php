<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfessorController extends Controller
{
    //

    public function listar()
    {
        $professores = Professor::paginate(7);
        return view('professores.professor-listar',compact('professores'));
    }

    public function create(){

        return view("professores.professor-form");
    }

    public function store(Request $request)
    {
        //$professor = $request->all();      

        //dd($request->input('nome'));

        Professor::create([
            "nome"=>$request->input('nome')
        ]);
        return redirect()->route('professor.create')->with('success','Professor adicionado!');
    }

    public function destroy(string $id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();
        
        return redirect()->route('professor.listar', $id)->with('success', 'Professor removido com successo');
    }

    public function update(Request $request, string $id)
    {
        $professor = Professor::find($id);
        $professor->nome = $request->input('namee');
        $professor->save();
        return redirect()->route('professor.edit', $id)->with('success', 'Professor atualizado com successo');

    }

    public function edit(string $id)
    {
        $professor = DB::table('professors')->where('id', $id)->first();
       
        return view('professores.professor-edit', compact('professor'));
    }
    
}
