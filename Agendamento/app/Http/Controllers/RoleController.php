<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //    $this->middleware('permission:role-list|role-create|role-edit|role-delete')->only(['index', 'store']);
    //    $this->middleware('permission:role-create')->only(['create', 'store']);
    //    $this->middleware('permission:role-edit')->only(['edit', 'update']);
    //    $this->middleware('permission:role-delete')->only(['destroy']);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $roles = Role::orderBy('id')->paginate(10);
        $permissions = Permission::all(); // 🔹 Adicionado para carregar todas as permissões

        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'array',
        ])->validate();

        // Criar Role com o guard correto
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web', // Definir explicitamente o guard correto
        ]);

        // Buscar permissões pelo guard correto
        $permissions = Permission::whereIn('id', array_map('intval', $request->input('permission', [])))
            ->where('guard_name', 'web') // Filtrar pelo guard correto
            ->get();

        // Associar Permissões
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Papel criado com sucesso');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validação correta
        Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'array',
        ])->validate();

        // Encontrar a Role
        $role = Role::findOrFail($id);

        // Atualizar nome da Role
        $role->update([
            'name' => $request->input('name'),
            'guard_name' => 'web', // Garantir que está no guard correto
        ]);

        // Buscar permissões pelo guard correto
        $permissions = Permission::whereIn('id', array_map('intval', $request->input('permission', [])))
            ->where('guard_name', 'web') // Filtrar pelo guard correto
            ->get();

        // Atualizar Permissões
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Papel atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('roles.index')
                ->with('error', 'Papel não encontrado');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Papel deletado com sucesso');
    }

}
