<?php

namespace App\Http\Controllers;

use App\Models\Entidade;
use App\Models\Gestao;
use App\Models\Role;
use App\Models\Team;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editAll()
    {
        //
        $u = User::select('id', 'matricula')->get()->toArray();

        $roles = Role::all();
        $teams = Team::all();
        $gestoes = Gestao::where("ativa", "=", "Sim")->get();
        $entidades = Entidade::all();
        $unidades = Unidade::all();
        return view('site.users.usuarios', compact('u', 'roles', 'teams', 'gestoes', 'entidades', 'unidades'));
    }
    public function storeEdit(Request $request)
    {
        //

        foreach ($request->usuarios as $i) {
            $user = User::find($i);
            if (isset($request->team)) {
                $user->team_id = $request->team;
            }
            if (isset($request->gestao)) {

                $user->gestao_id = $request->gestao;
            }
            if (isset($request->role)) {
                //Retorna os cargos que estão relacionados ao usuário selecionado constantes na tabela role_user
                $idcargo = DB::table('role_user')
                    ->select('role_id')
                    ->where('user_id', $user['id'])
                    ->get()->toArray();
                //Transforma em array
                $idcargo = json_decode(json_encode($idcargo), true);

                if (isset($idcargo)) {
                    //
                    $removerCargo = [];
                    foreach ($idcargo as $i) {

                        $removerCargo[] = $i['role_id'];
                    }
                    foreach ($removerCargo as $i) {
                        $user->detachRole($i);
                    };
                } //endif

                $user->attachRole($request->role);
            }

            if (isset($request->entidade)) {

                $user->entidade_id = $request->entidade;
            }

            if (isset($request->unidade)) {

                $user->unidade_id = $request->unidade;
            }

            $user->save();
        }

   return (redirect(route("usuarios.editAll")));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $superadministrator = Role::find(1);
    //     $user = User::findOrFail($id)->get();
    //     $user->attachRole($superadministrator);

    //     $teste = $user->hasRole('administrador');
    //     return $teste;
    // }


    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);


        if (isset($request->team)) {
            $user->team_id = $request->team;
        }
        if (isset($request->gestao)) {

            $user->gestao_id = $request->gestao;
        }
        if (isset($request->role)) {


            //Retorna os cargos que estão relacionados ao usuário selecionado constantes na tabela role_user
            $idcargo = DB::table('role_user')
                ->select('role_id')
                ->where('user_id', $user['id'])
                ->get()->toArray();
            //Transforma em array
            $idcargo = json_decode(json_encode($idcargo), true);

            if (isset($idcargo)) {
                //
                $removerCargo = [];
                foreach ($idcargo as $i) {

                    $removerCargo[] = $i['role_id'];
                }
                foreach ($removerCargo as $i) {
                    $user->detachRole($i);
                };
            } //endif

            //dd($idcargo);
            $user->attachRole($request->role);
        }

        if (isset($request->entidade)) {

            $user->entidade_id = $request->entidade;
        }
        if (isset($request->unidade)) {

            $user->unidade_id = $request->unidade;
        }
        $user->save();
        return redirect(route('usuarios.index'));
    }
    public function index()
    {
        //Retorna view com a listagem dos usuários para administradores
        $roles = Role::all();
        $teams = Team::all();
        $gestoes = Gestao::all();
        $entidades = Entidade::all();
        $unidades = Unidade::all();

        $user = json_decode(json_encode(
            DB::table('users')->select(
                'users.id',
                'users.name',
                'users.matricula',
                'users.email',
                'unidades.name as unidade',
                'teams.display_name',
                'users.created_at'
            )
                ->join('unidades', 'users.unidade_id', '=', 'unidades.id')->join('teams', 'users.team_id', '=', 'teams.id')->get()->toArray()
        ), true);
        return   view('site.users.index_usuarios', compact('user', 'roles', 'teams', 'gestoes', 'entidades', 'unidades'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    // public function indexJson()
    // {
    //     $users = User::all();
    //     return json_encode($users);
    // }
}
