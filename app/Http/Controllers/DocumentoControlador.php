<?php

namespace App\Http\Controllers;

use App\Models\Ata;
use App\Models\Oficio;
use App\Models\Portaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //O Index mostrará todos os documentos registrados no sistema

        /*============Ofícios============*/
        $ofc = Oficio::select(
            'oficios.id',
            'entidades.name',
            'oficios.titulo',
            'oficios.autor',
            'oficios.created_at',
            'oficios.updated_at',
            'oficios.assinado'
        )->join('entidades', 'oficios.entidade_id', '=', 'entidades.id')->get();


        /*============Atas============*/
        $ata = Ata::select(
            'atas.id',
            'entidades.name',
            'atas.titulo',
            'atas.autor',
            'atas.created_at',
            'atas.updated_at',
            'atas.assinado'
        )->join('entidades', 'atas.entidade_id', '=', 'entidades.id')->get();
        /*============Portarias============*/
        $port = Portaria::select(
            'portarias.id',
            'entidades.name',
            'portarias.titulo',
            'portarias.autor',
            'portarias.created_at',
            'portarias.updated_at',
            'portarias.assinado'
        )->join('entidades', 'portarias.entidade_id', '=', 'entidades.id')->get();

        $fireAlert = true;

        return view("site.documentos.documentos", compact('ofc', 'ata','port', 'fireAlert'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Método para levar à página de criação de documentos
        return view("site.documentos.novodocumento");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Método para inserir no BD
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    public function meus()
    {
        /*============Ofícios============*/

        $ofc = Oficio::select(
            'oficios.id',
            'entidades.name',
            'oficios.titulo',
            'oficios.autor',
            'oficios.created_at',
            'oficios.updated_at',
            'oficios.assinado'
        )->where('autor', Auth::user()->name)->join('entidades', 'oficios.entidade_id', '=', 'entidades.id')


            ->get();

        /*============Atas============*/
        $ata = Ata::select(
            'atas.id',
            'entidades.name',
            'atas.titulo',
            'atas.autor',
            'atas.created_at',
            'atas.updated_at',
            'atas.assinado'
        )->join('entidades', 'atas.entidade_id', '=', 'entidades.id')->get();

        /*============Portarias============*/
        $port = Portaria::select(
            'portarias.id',
            'entidades.name',
            'portarias.titulo',
            'portarias.autor',
            'portarias.created_at',
            'portarias.updated_at',
            'portarias.assinado'
        )->join('entidades', 'portarias.entidade_id', '=', 'entidades.id')->get();



        return view("site.documentos.meus_documentos", compact('ofc', 'ata', 'port'));
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
