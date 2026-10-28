<?php

namespace App\Http\Controllers;

use App\Models\BolsaCopia;
use App\Models\Entidade;
use App\Models\Fardas_encomenda;
use App\Models\Financa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiaeControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function encomendarfardas()
    {
        //
        return view('site.gremio.diae.fardas.encomendar_fardas');
    }
    public function storefardas(Request $request)
    {
        //

        if (isset($request)) {
            $input = $request->validate([
                'name' => 'required|string|max:255|unique:entidades',
                'telefone' => 'required|string|max:255|unique:entidades',
                 'tamanho' => 'string|required',
                'quantidade' => 'required',


            ], [
                'required' => "Este campo é obrigatório.",
                'unique' => "Nome já utilizado.",
                'max' => "O limite de caracteres foi excedido",
                'mimes' => "O formato do arquivo não é suportado."
            ]);
            $farda = new Fardas_encomenda();
            $farda->name = $request->input('name');
            $farda->telefone = $request->input('telefone');
            $farda->tamanho = $request->input('tamanho');
            $farda->quantidade = $request->input('quantidade');
            $farda->matricula = Auth::user()->matricula;

            $farda->unidade_id = Auth::user()->unidade_id;


            $farda->save();
        }
        return redirect((route('fardas.encomendar')));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retorna a quantidade de fardas de tipo
        //Array com todos os tamanhos para auxiliar no laço de repetição
        $aux = array(0 => "PP", 1 =>  "P", 2 =>  "M", 3 => "G", 4 => "GG", 5 => "PP-BL", 6 => "P-BL", 7 => "M-BL", 8 => "G-BL", 9 => "GG-BL");

        // $encomendas = array();
        // //Laço que colocará no array $encomendas a quantidade de cada tamanho encomendados
        // foreach ($aux as $a) {
        //     //Retorna a quantidade de entradas onde se encontra o tamanho.
        //     $tamanho =  Fardas_encomenda::where("tamanho", "=", $a)->count();
        //     //Retorna o campo "quantidade" de cada tamanho
        //     $qnt = Fardas_encomenda::select("quantidade")->where("tamanho", "=", "$a")->get()->toArray();
        //     //Verifica se não está vazio para não dar Undefined key 0
        //     if (!empty($qnt)) {
        //         //Retira o número do array ou coloca 0 caso não haja nenhuma encomenda com aquele tamanho
        //         $qnt = $qnt[0]['quantidade'];
        //     } else {
        //         $qnt = 0;
        //     }
        //     $encomendas[] = $tamanho * $qnt;
        // }

        $encomendas = stdToArray(Fardas_encomenda::select(
            'fardas_encomendas.id',
            'fardas_encomendas.name as comprador',
            'telefone',
            'matricula',
            'unidades.name',
            'tamanho',
            'quantidade'
        )->where('unidades.id', '=', Auth::user()->unidade_id)->join('unidades', 'fardas_encomendas.unidade_id', '=', 'unidades.id')->get());
         if (isset($fireAlert)) {
            return view('site.gremio.diae.fardas.index_fardas', compact("encomendas", 'fireAlert'));
        } else {
            $fireAlert = false;
            return view('site.gremio.diae.fardas.index_fardas', compact("encomendas", 'fireAlert'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $input = $request->validate([
            // 'id' => 'required|number|max:255 ',
            'participante' => 'required|string|max:255 ',
            'mododepagamento' => 'required|string|max:255 ',
            'telefone' => 'required|string',
            'tamanho' => 'required',
            'preco' => 'required',
            'quantidade' => 'required',
            'cpfgremista' => 'required',
            'cpfparticipante' => 'required|string|max:30',
            'comprovante' => 'required|file|mimes:jpg,jpeg,pdf,png',

        ], [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi atingido",
            'mimes' => "O formato do arquivo não é suportado."
        ]);
        //Tratamento do comprovante
        $file = $input['comprovante'];

        $entidade = Entidade::find(Auth::user()->entidade_id);
        $input['identificacao'] = "Venda de " . $input['quantidade'] . " fardas " . $input['tamanho'] . " a " . $input['participante'];

        $path = $file->storeAs('public/entidades/' . $entidade->sigla . '/Financeiro', 'Comprovante - ' . $input['identificacao'] .
            '.' . $input['comprovante']->extension(), 'public');
        $input['comprovante'] = $path;

        $input['valor'] = $input['preco'] * $input['quantidade'];
        $input['entidade_id'] = Auth::user()->entidade_id;
        $input['gremista'] = Auth::user()->name;
        $input['tipo'] = "Entrada";

        Financa::create($input);


        //Parte do grêmio
        $input = $request->validate([
            'participante' => 'required|string|max:255 ',
            'mododepagamento' => 'required|string|max:255 ',
            'telefone' => 'required|string',
            'tamanho' => 'required',
            'lucro' => 'required',
            'quantidade' => 'required',
            'cpfgremista' => 'required',
            'cpfparticipante' => 'required|string|max:30',
            'comprovante' => 'required|file|mimes:jpg,jpeg,pdf,png',

        ], [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi atingido",
            'mimes' => "O formato do arquivo não é suportado."
        ]);
        //Tratamento do comprovante
        $file = $input['comprovante'];

        $entidade = Entidade::find(Auth::user()->entidade_id);
        $input['identificacao'] = "Lucro da Entidade da venda de " . $input['quantidade'] . " fardas " . $input['tamanho'] . " a " . $input['participante'];

        $path = $file->storeAs('public/entidades/' . $entidade->sigla . '/Financeiro', 'Comprovante - ' . $input['identificacao'] .
            '.' . $input['comprovante']->extension(), 'public');
        $input['comprovante'] = $path;

        $input['valor'] = $input['lucro'] * $input['quantidade'];
        $input['entidade_id'] = Auth::user()->entidade_id;
        $input['gremista'] = Auth::user()->name;
        $input['tipo'] = "Entrada";

        Financa::create($input);

        $f = Fardas_encomenda::find($id);
        $f->destroy($id);
        $fireAlert = true;
        return redirect(route('fardas.index', compact('fireAlert')));
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


    // --------------------------------------------------------- Bolsa Cópia ---------------------------------------------------------

    public function bolsacopia()
    {
        //Retorna view index_bolsacopia
        $bolsas = stdToArray(DB::table('bolsacopia')->select(
            'bolsacopia.id',
            'bolsacopia.name as name',
            'bolsacopia.matricula',
            'bolsacopia.laudas',
            'bolsacopia.gremista',
            'unidades.name as entidade',
            'bolsacopia.created_at',
            'bolsacopia.updated_at'
        )->where("bolsacopia.unidade_id", '=', Auth::user()->unidade_id)->join('unidades', 'bolsacopia.unidade_id', '=', 'unidades.id')->get());
        return view('site.gremio.diae.bolsacopia.index_bolsacopia', compact('bolsas'));
    }
    //Retorna view de criação de novo registro do bolsa cópia
    public function createbc()
    {
        return view('site.gremio.diae.bolsacopia.criar_bolsacopia');
    }





    //Route que salva novo registro feito em createbc()
    public function storebc(Request $request)
    {
        //

        if (isset($request)) {

            $bc = new BolsaCopia;
            $bc->name = $request->input('name');
            $bc->matricula = $request->input('matricula');
            $bc->laudas = $request->input('laudas');
            $bc->gremista = Auth::user()->name;
            $bc->unidade_id = Auth::user()->unidade_id;


            $bc->save();
        }
        return redirect(route('bolsacopia.index'));
    }







    public function updatebc(Request $request, $id)
    {
        if (isset($request)) {
            $bc = BolsaCopia::find($id);
            $bc->laudas = $bc->laudas + $request->input('laudas');
            $bc->save();
        }
        return redirect(route('bolsacopia.index'));
        //
    }

    public function teste()
    {
        return view('suap.index');
    }

    public function bcLimiteStore()
    {
    }
}
