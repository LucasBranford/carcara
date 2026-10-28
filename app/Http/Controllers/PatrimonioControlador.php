<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Entidade;
use App\Models\PatrimonioAtivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatrimonioControlador extends Controller
{
    //
    public function index()
    {


        $patrimonio = stdToArray(PatrimonioAtivo::select(
            "patrimonioativo.id",
            "patrimonioativo.name",
            "patrimonioativo.identificacao",
            "patrimonioativo.observacao",
            "patrimonioativo.obtencao",
            "patrimonioativo.custo",
            "patrimonioativo.emprestavel",
            "patrimonioativo.gremista",
            "entidades.name as entidade"
        )->join('entidades', 'patrimonioativo.entidade_id', '=', 'entidades.id')->get());
        return view('site.gremio.patrimonio.index_patrimonio', compact('patrimonio'));
    }

    public function entidade()
    {


        // $patrimonio = stdToArray(DB::table("patrimonioativo")->select(
        //

        // )->where('patrimonioativo.entidade_id','=',Auth::user()->entidade_id)->//join('entidades', 'patrimonioativo.entidade_id', '=', 'entidades.id')->
        // get());
        $patrimonio = stdToArray(
            PatrimonioAtivo::select(
                "patrimonioativo.id",
                "patrimonioativo.name",
                "patrimonioativo.identificacao",
                "patrimonioativo.observacao",
                "patrimonioativo.obtencao",
                "patrimonioativo.custo",
                "patrimonioativo.emprestavel",
                "patrimonioativo.gremista"
            )->where('patrimonioativo.entidade_id', '=', Auth::user()->entidade_id)->get()
        );
        return view('site.gremio.patrimonio.entidade_patrimonio', compact('patrimonio'));
    }


    public function create()
    {
        return view('site.gremio.patrimonio.criar_patrimonio');
    }

    public function store(Request $request)
    {

        $input = $request->validate([
            'name' => 'required|string|max:255',
            'identificacao' => 'required|string',
            'observacao' => 'required|max:255',
            'obtencao' => 'required|string',
            'custo' => 'required|integer',
            'emprestavel' => 'required|string',
        ], [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi excedido",

        ]);
        //O sistema definirá a pertença do patrimônio a uma entidade baseado na entidade
        //do gremista que registra o objeto
        $input['entidade_id'] = Auth::user()->entidade_id;
        $input['gremista'] = Auth::user()->name;
        //Todos os objetos são cadastrados inicialmente como não emprestados
        $input['emprestado'] = "Não";

        PatrimonioAtivo::create($input);
        return redirect(route('patrimonio.entidade'));
    }

    public function update(Request $request, $id)
    {
        $p = PatrimonioAtivo::find($id);
        if (isset($p)) {

            $p->name = $request->input('name');
            $p->identificacao = $request->input('identificacao');
            $p->observacao = $request->input('observacao');
            $p->obtencao = $request->input('obtencao');
            $p->emprestavel = $request->input('emprestavel');
            $p->custo = $request->input('custo');
            $p->gremista = Auth::user()->name;



            $p->save();
        }
        return redirect(route('patrimonio.entidade'));
    }
    // Empréstimo

    public function indexEmprestimo()
    {
        $fireAlert = false;
        $e = Emprestimo::select(
            "emprestimos.id",
            "emprestimos.name as name",
            "patrimonioativo.name as objeto",
            "data_devolucao",
            "emprestimos.matricula",
            "gremista_emprestou",
            "gremista_devolvido",
            "status",
            "emprestimos.created_at"
        )->join("patrimonioativo", "patrimonioativo.id", "=", "emprestimos.patrimonio_id")->get()->toArray();

        return view('site.gremio.patrimonio.emprestimo.index_emprestimo', compact('e', 'fireAlert'));
    }
    public function criarEmprestimo()
    {
        $e = PatrimonioAtivo::where("emprestado", "=", "Não")->where("emprestavel", "=", "Sim")
        ->where("entidade_id", "=", Auth::user()->entidade_id)->get();

        if (isset(Auth::user()->entidade_id) && isset(Auth::user()->gestao_id)) {
            $fireAlert = false;

            return view('site.gremio.patrimonio.emprestimo.criar_emprestimo', compact('e', 'fireAlert'));
        } else {

            $fireAlert = true;
            return view('site.gremio.patrimonio.emprestimo.index_emprestimo', compact('e', 'fireAlert'));
            // return view('site.gremio.patrimonio.emprestimo.criar_emprestimo',compact('e','fireAlert'));}

        }
    }
    public function storeEmprestimo(Request $request)
    {

        $input = $request->validate([
            'name' => 'required|string|max:255',
            'patrimonio_id' => 'required|numeric|',
            'matricula' => 'required|string|max:255',
        ], [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi excedido",

        ]);
        $input['gremista_emprestou'] = Auth::user()->name;
        $input['status'] = "Emprestado";
        Emprestimo::create($input);
        //Retorna o objeto da tabela PatrimônioAtivo
        $obj = PatrimonioAtivo::find($input['patrimonio_id']);
        $obj->emprestado = "Sim";
        $obj->save();

        return redirect(route('patrimonio.indexEmprestimo'));
    }

    public function updateEmprestimo(Request $request, $id)
    {
        $p = Emprestimo::find($id);

        if (isset($p)) {

            $p->data_devolucao = now();
            $p->gremista_devolvido = Auth::user()->name;
            $p->status = "Encerrado";


            $p->save();

            $patrimonio = $p->patrimonio_id;
            $pat = PatrimonioAtivo::find($patrimonio);
            $pat->emprestado = "Não";
            $pat->save();
        }


        return redirect(route('patrimonio.indexEmprestimo'));
    }
}
