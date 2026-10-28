<?php

namespace App\Http\Controllers;

use App\Models\BolsaCopiaLimite;
use Illuminate\Http\Request;

use App\Models\Cargo;
use App\Models\Entidade;
use App\Models\Diretoria;
use App\Models\Unidade;

class EntidadeControlador extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todas = Entidade::all();
        return view('site.entidade.entidade', compact('todas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //->except('index');
        $unidade = Unidade::all();
        return view('site.entidade.create_entidade', compact('unidade'));
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
                'name' => 'required|string|max:255|unique:entidades',
                'sigla' => 'required|unique:entidades',
                'email' => 'required|email|max:255|unique:entidades',
                'instagram' => 'required|string|max:255|unique:entidades',
                'telefone' => 'required|string|max:255|unique:entidades',
                'unidade_id' => 'required',
                'endereco' => 'required|string|max:255',
                'datafundacao' => 'required|date',
                'atafundacao' => 'file|mimes:jpg,jpeg,pdf,png',
                'estatuto' => 'required|file|mimes:pdf',
                'logo' => 'required|file|mimes:jpg,jpeg,png',

            ], [
                'required' => "Este campo é obrigatório.",
                'unique' => "Nome já utilizado.",
                'max' => "O limite de caracteres foi excedido",
                'mimes' => "O formato do arquivo não é suportado."
            ]);
            //Tratamento da ata de fundação
            $file = $input['atafundacao'];
            $path = $file->storeAs('public/entidades/' . $input['sigla'] . '/Ata de Fundação', 'Ata de Fundação - ' . $input['name'] .
                '.' . $input['atafundacao']->extension(), 'public');
            $input['atafundacao'] = $path;

            //Tratamento da logo
            $file = $input['logo'];
            $pathe = $file->storeAs('public/entidades/' . $input['sigla'], 'LOGO - ' . $input['name'] .
                '.' . $input['logo']->extension(), 'public');
            $input['logo'] = $pathe;

            //Tratamento do estatuto
            $file = $input['estatuto'];
            $pathe = $file->storeAs('public/entidades/' . $input['sigla'], 'Estatuto - ' . $input['name'] .
                '.' . $input['estatuto']->extension(), 'public');
            $input['estatuto'] = $pathe;
            Entidade::create($input);
 
         
        return redirect(route('entidades'));
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
        $ent = Entidade::find($id);
        $data = Unidade::all();
 
        return view('site.entidade.editentidade', compact('ent', 'data'));
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
        //Recupera dados da entidade se houver $id
        $ent = Entidade::find($id);
        if (isset($ent)) {
            $ent->name = $request->input('name');
            $ent->sigla = $request->input('sigla');
            $ent->email = $request->input('email');
            $ent->instagram = $request->input('instagram');
            $ent->telefone = $request->input('telefone');
            $ent->unidade_id = $request->input('unidade');
            $ent->endereco = $request->input('endereco');
            $ent->datafundacao = $request->input('datafundacao');
            $ent->dataofc = $request->input('dataofc');

            // Tratamento do Arquivo da ata de fundação
            //Primeiro deve-se verificar se a pessoa está alterando o arquivo
            if (!empty($request->atafundacao)) {

                //Tratamento da ata de fundação
                $file = $request->atafundacao;
                $path = $file->storeAs('public/entidades/' . $request->sigla . '/Ata de Fundação', 'Ata de Fundação - ' . $request->sigla .
                    '.' . $file->extension(), 'public');
                $ent->atafundacao = $path;
            }

            if (!empty($request->logo)) {
                //Transforma o nome do arquivo em Logo SIGLA.* (extensão original)

                //Tratamento da ata de fundação
                $file = $request->logo;
                $path = $file->storeAs('public/entidades/' . $request->sigla, 'LOGO - ' . $request->sigla .
                    '.' . $file->extension(), 'public');
                $ent->logo = $path;
            }
            if (!empty($request->estatuto)) {
                //Transforma o nome do arquivo em Logo SIGLA.* (extensão original)

                //Tratamento da ata de fundação
                $file = $request->estatuto;
                $path = $file->storeAs('public/entidades/' . $request->sigla, 'estatuto - ' . $request->sigla .
                    '.' . $file->extension(), 'public');
                $ent->estatuto = $path;
            }
            $ent->save();


            return redirect(route('entidades.editar', $id));
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
