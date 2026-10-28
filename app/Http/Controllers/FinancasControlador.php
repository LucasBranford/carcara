<?php

namespace App\Http\Controllers;

use App\Models\Entidade;
use App\Models\Financa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancasControlador extends Controller
{
    /**
     * Mostra a lista de todas as movimentações de todas as entidades
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fin = json_decode(json_encode(
            DB::table('financas')->select(
                'financas.id',
                'entidades.name',
                'financas.identificacao',

                'financas.tipo',
                'financas.mododepagamento',
                'financas.valor',
                'financas.participante',
                'financas.gremista',
                'financas.created_at',
                'financas.updated_at',

            )
                ->join('entidades', 'financas.entidade_id', '=', 'entidades.id')->get()->toArray()
        ), true);

        return view('site.gremio.financas.index_financas', compact('fin'));
    }

    /**
     * Mostra o formulário para criar nova movimentação.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("site.gremio.financas.criar_financas");
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
            'tipo' => 'required|string|max:255',
            'identificacao' => 'required|string|max:255',
            'mododepagamento' => 'required|string',
            'valor' => 'required|integer',
            'participante' => 'required|string|max:255',
            'cpfparticipante' => 'required|string',
            'cpfgremista' => 'required|string|max:255',
            'comprovante' => 'required|file|mimes:jpg,jpeg,pdf,png',

        ], [
            'required' => "Este campo é obrigatório.",
            'unique' => "Nome já utilizado.",
            'max' => "O limite de caracteres foi excedido",
            'mimes' => "Apenas arquivos de extensão .jpg,.png ou .pdf são suportados.."
        ]);
        //Tratamento do comprovante
        $file = $input['comprovante'];

        $entidade = Entidade::find(Auth::user()->entidade_id);
         $path = $file->storeAs('public/entidades/' . $entidade->sigla . '/Financeiro', 'Comprovante - ' . $input['identificacao'] .
            '.' . $input['comprovante']->extension(), 'public');
        $input['comprovante'] = $path;

        $input['gremista'] =  Auth::user()->name;
        $input['entidade_id'] =  Auth::user()->entidade_id;

        Financa::create($input);
        // if (isset($request)) {
        //     $fin = new Financa;

        //     $fin->entidade_id =  Auth::user()->entidade_id;;
        //     $fin->valor = $request->input('valor');
        //     $fin->tipo = $request->input('tipo');
        //     $fin->mododepagamento = $request->input('mododepagamento');
        //     $fin->participante = $request->input('participante');
        //     $fin->cpfparticipante = $request->input('cpfparticipante');
        //     $fin->gremista =
        //     $fin->cpfgremista = $request->input('cpfgremista');
        //     $fin->save();
        // }
        return redirect(route('financas.criar'));
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
     * Retorna os valores apenas da entidade da pessoa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function entidade()
    {
        //
        $fin = json_decode(json_encode(
            DB::table('financas')->select(
                'financas.id',
                'financas.tipo',
                'financas.mododepagamento',
                'financas.valor',
                'financas.participante',
                'financas.cpfparticipante',
                'financas.gremista',
                'financas.cpfgremista',
                'financas.created_at',
                'financas.updated_at',

            )
                ->where('entidade_id', '=', Auth::user()->entidade_id)->get()->toArray()
        ), true);

        return view('site.gremio.financas.entidade_financas', compact('fin'));
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
