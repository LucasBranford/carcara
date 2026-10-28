<?php

namespace App\Http\Controllers;

use App\Models\Entidade;
use App\Models\Gestao;
use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestaoControlador extends Controller
{





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Entidade::all();
        return view('site.entidade.gestao.create_gestoes', compact('data'));
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
            'name' => 'required|string|max:255|unique:gestoes',
            'entidade_id' => 'required',
            'atadeposse' => 'required|file|mimes:jpg,jpeg,pdf,png',
            'inicio'     => 'required|date'

        ], [
            'required' => "Este campo é obrigatório.",
            'unique' => "Já há uma gestão com esse nome."
        ]);
        $file = $input['atadeposse'];
        $entidade = Entidade::where('id', $input['entidade_id'])->get();
        $entidade = objToArray($entidade);
        $path = $file->storeAs('public/entidades/' . $entidade['sigla'] . '/Atas de Posse', 'Ata de Posse - Gestão ' . $input['name'] . '.' . $input['atadeposse']->extension(), 'public');
        $input['atadeposse'] = $path;





        //Arquiva as outras gestões
               $outras = Gestao::all()->toArray();
         if (!empty($outras)) {
            $outras = Gestao::where('ativa', '=', 'Sim')->where('entidade_id', '=', $input['entidade_id'])->update(['ativa' => 'Não']);
        } else {
            echo 'a';
        }
        Gestao::create($input);


        return redirect(route('gestao.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gestoes = DB::table('gestoes')->select(
            'gestoes.id',
            'gestoes.name',
            'entidades.name as entidade',
            'gestoes.provisoria',
            'gestoes.ativa',
            'gestoes.inicio',
            'gestoes.termino',
            'gestoes.created_at',
            'gestoes.atadeposse',


        )->where('ativa', '=', 'Sim')->join(
            'entidades',
            'gestoes.entidade_id',
            '=',
            'entidades.id'
        )->get();

        //Retira os stdclass objects e transforma tudo em array
        $gestoes = json_decode(json_encode($gestoes), true);



        //Retorna os membros de uma gestão


        $pessoas = json_decode(json_encode(
            DB::table('users')->select('users.id', 'users.name as nomeusuario', 'users.matricula', 'users.email', 'users.telefone', 'gestoes.name')
                ->join("gestoes", 'users.gestao_id', '=', 'gestoes.id')->get()->toArray()
        ), true);;


        // return dd($pessoas);
        return view('site.entidade.gestao.index_gestoes', compact('gestoes', 'pessoas'));
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
        $data = objToArray(Gestao::where('id', $id)->get());

        return view("site.entidade.gestao.editar_gestoes", compact('data'));
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

        $gestao = Gestao::find($id);
        if (isset($gestao)) {
            $gestao->name = $request->input('name');
            $gestao->inicio = $request->input('inicio');
            $gestao->termino = $request->input('termino');
            $gestao->ativa = false;
            $gestao->save();
        }
        return redirect(route('gestao.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}
