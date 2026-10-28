<?php

namespace App\Http\Controllers;

use App\Models\Manifestacao;
use Illuminate\Http\Request;

class OuvidoriaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('site.ouvidoria.index_ouvidoria');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('site.ouvidoria.criar_manifestacao');

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
     * @param  \App\Models\Manifestacao  $manifestacao
     * @return \Illuminate\Http\Response
     */
    public function show(Manifestacao $manifestacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manifestacao  $manifestacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Manifestacao $manifestacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manifestacao  $manifestacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manifestacao $manifestacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manifestacao  $manifestacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manifestacao $manifestacao)
    {
        //
    }
}
