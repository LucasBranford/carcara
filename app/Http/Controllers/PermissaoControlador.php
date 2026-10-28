<?php

namespace App\Http\Controllers;

use App\Models\Entidade;
use App\Models\Gestao;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class PermissaoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $teams = Team::all();
        $gestoes = Gestao::all();
        $entidades = Entidade::all();
        return view('site.permissoes.atribuir_permissoes',compact('users','roles','teams','gestoes','entidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function editar(Request $request)
    {
        $user = User::find($request->user);
        $user->team_id = $request->team;
        $user->gestao_id = $request->gestao;
        $user->attachRole($request->role);
        $user->entidade_id = $request->entidade;
        $user->save();
        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
