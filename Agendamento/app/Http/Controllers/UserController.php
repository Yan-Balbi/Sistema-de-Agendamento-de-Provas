<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

use App\Rules\CpfValidation;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;


class UserController extends Controller
{
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = User::paginate(10); // Obtém os usuários
        $roles = Role::all(); // Obtém todas as roles

        return view('users.index', compact('data', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'), ['mode' => 'createadmin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        // Validação correta
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:18', Rule::unique('users'), new CpfValidation()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['sometimes', 'nullable', 'min:8'],
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ])->validate();

        // Criar Usuário
        $user = User::create([
            'name' => $request->input('name'),
            'cpf' => preg_replace('/\D/', '', $request->input('cpf')),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Associar Roles ao Usuário
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index', ['mode' => 'createadmin'])->with('success', 'Usuário criado com sucesso');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('users.show', compact('user'), ['mode' => 'show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'), ['mode' => 'edit']);
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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:18', Rule::unique('users')->ignore($id), new CpfValidation()],
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($id)],
            'password' => ['sometimes', 'nullable', 'min:8'],
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ])->validate();

        $user = User::findOrFail($id);

        // Verifica se a senha foi preenchida, se não, mantém a antiga
        $password = $request->filled('password')
            ? Hash::make($request->input('password'))
            : $user->password;

        // Atualizar os dados do usuário
        $user->update([
            'name' => $request->input('name'),
            'cpf' => preg_replace('/\D/', '', $request->input('cpf')),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
        ]);

        // Atualizar Roles do Usuário
        $user->syncRoles($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Usuário deletado com sucesso');
    }
}
