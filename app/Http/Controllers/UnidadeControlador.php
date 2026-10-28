<?php

namespace App\Http\Controllers;

use App\Models\Entidade;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnidadeControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retorna as unidades administrativas (campi)
        $unidades = stdToArray(DB::table("unidades")->select('id', 'name', 'sigla', 'cidade', 'endereco')->get());
        return   view("site.unidades.index_unidades", compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("site.unidades.criar_unidades");
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

        $input = $request->validate([
            'name' => 'required|string|max:255',
            'sigla' => 'required|string|max:6|unique:unidades',
            'endereco' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',


        ], [
            'required' => "Este campo é obrigatório.",
            'sigla.unique' => "Esta sigla já está em uso.",
            'max' => "O número máximo de caracteres foi excedido."
        ]);
        $input['sigla'] = strtoupper($input['sigla']);
        Unidade::create($input);
        return redirect(route('unidades.index'));
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
    public function edit($id)
    {
        //
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
        $unidade = Unidade::find($id);


        if (isset($request->name)) {
            $unidade->name = $request->name;
        }
        if (isset($request->sigla)) {

            $unidade->sigla = $request->sigla;
        }

        if (isset($request->endereco)) {

            $unidade->endereco = $request->endereco;
        }
        if (isset($request->cidade)) {

            $unidade->cidade = $request->cidade;
        }

        $unidade->save();
        return redirect(route('unidades.index'));
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
        $unidade = Unidade::find($id);
        if (isset($unidade)) {
            $unidade->delete();
        }
        return redirect(route('unidades.index'));
    }
    public function listar()
    {
    }
}
