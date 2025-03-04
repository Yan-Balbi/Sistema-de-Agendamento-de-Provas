<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = Sala::paginate(5);
        return view('salas.sala-index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('salas.sala-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Sala::create($input);
        return redirect()->route('salas.create')->with('success','Sala adicionada!');
    }

    public function getSalaById(Request $request){
        $sala = DB::table('salas')->where('id', $request->id)->first();
        // return response()->json($sala);
        return View('salas.editar-sala', compact('sala'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sala = DB::table('salas')->where('id', /*$request->*/$id)->first();
        // return response()->json($sala);
        return View('salas.editar-sala', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Sala::find($id);
        $item->nome = $request->input('namee');
        $item->save();
        return redirect()->route('salas.edit', $id)->with('success', 'Sala atualizada com successo');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
