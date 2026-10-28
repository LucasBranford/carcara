<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Diretoria;
use App\Models\Permi;

class CargoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cargo = Cargo::join('diretorias', 'diretorias.id', '=', 'cargos.diretoria_id')
     ->select('cargos.id', 'cargos.name', 'diretorias.name_diretoria', 'cargos.regif', 'cargos.gedm', 'cargos.gevp', 'cargos.created_at', 'cargos.updated_at')->get();

    
   
        //Retorna diretorias
        $diretoria = Diretoria::all();

        return view('site.cargos.cargos', compact('cargo', 'diretoria'));
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
        $cargo = new Cargo();
        if(isset($request)){
            $cargo->name = $request->name;
            $cargo->diretoria_id = $request->diretoria;
            $cargo->save();
            return redirect(route('cargos'));
        }

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
        //Verifica se há request para add


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
        if (isset($id) && null !== $request->input('addcargo')) {

            $cargo = Cargo::where('id', '=', $id)->update([$request->input('sigla') => true]);
            return redirect(route('entidades.editar', $request->input('entid')));
        }
        if (isset($id) && null !== $request->input('rmvcargo')) {

            $cargo = Cargo::where('id', '=', $id)->update([$request->input('sigla') => false]);
            return redirect(route('entidades.editar',$request->input('entid')));
        }

        if (isset($id) && null !== $request->input('cargoalt')) {

            $cargo = Cargo::find($id);
            $cargo->name=$request->input('name');
             $cargo->diretoria_id=$request->input('diretoria');
            $cargo->save();
        return redirect('/cargos');
        }
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
