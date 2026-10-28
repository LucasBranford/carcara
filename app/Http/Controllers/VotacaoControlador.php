<?php

namespace App\Http\Controllers;

use App\Models\Entidade;
use App\Models\Gestao;
use App\Models\Nulo;
use App\Models\Opcao;
use App\Models\Unidade;
use App\Models\Votacao;
use App\Models\Voto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VotacaoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $votacoes =  stdToArray(DB::table("votacoes")->select(
            'id',
            'name',
            'descricao',
            'gremista',
            'inicio',
            'termino',
            'inicio_validacao',
            'termino_validacao',
            'status',
            'created_at',
            'updated_at'
        )->get());

        $fireAlert = false;
        return view('voto.index_votacao', compact('votacoes', 'fireAlert'));
    }

    public function votar()
    {
        $fireAlert = false;
        return view("voto.votar", compact('fireAlert'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $votacoes =  Votacao::where('termino', '>=', Carbon::now())->where('user_id', Auth::user()->id)->get();

        return view('voto.criar_votacao', compact('votacoes'));
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
            'descricao' => 'required|string|max:2000',
            'inicio' => 'required',
            'inicio_validacao' => 'required',
            'termino_validacao' => 'required',
            'termino' => 'required',



        ], [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi atingido",
        ]);
        //Associa a votação ao usuário que a criou
        $input['user_id'] = Auth::user()->id;

        $input['gremista'] = Auth::user()->name;
        $input['status'] = "Ativa";
        Votacao::create($input);
        $fireAlert = false;
        return redirect(route('votacao.minhas', $fireAlert));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function storeOpcao(Request $request)
    {
        $input = $request->validate([
            'votacao_id' => 'required',
            'name' => 'required|string|max:255',
            'descricao' => 'required|string|max:2000',



        ], [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi atingido",
        ]);

        $input['qnt_votos'] = 0;

        Opcao::create($input);

        return (redirect(route('votacao.create')));
    }


    public function show($id)
    {
        //

        $votacao =  Votacao::where('id', '=', $id)->get();
        if ($votacao->isNotEmpty() == true) {
            $votacao =  objToArray(Votacao::where('id', '=', $id)->get());
        } else {
            $fireAlert = true;
            return view("voto.votar", compact('fireAlert'));
        }

        if ($votacao['inicio'] <= Carbon::now() && $votacao['termino'] >= Carbon::now()) {
            $opcoes = Opcao::where('votacao_id', '=', $id)->get();
            $voto = Voto::where('user_id', Auth::user()->id)->where('votacao_id', $votacao['id'])->get();

            return view("voto.urna_votacao", compact('votacao', 'opcoes', 'voto'));
        } else {
            $fireAlert = true;
            return view("voto.votar", compact("fireAlert"));
        }
    }

    public function storeVoto(Request $request)
    {
        //Retorna a opção votada para adicionar mais um
        $opcao = Opcao::find($request->voto);
        $opcao->qnt_votos =  $opcao->qnt_votos + 1;
        $opcao->save();
        //Cria o voto na tabela votos
        $voto = new Voto;
        $input['votacao_id'] = $request->input('votacao_id');
        $input['user_id'] = Auth::user()->id;
        $input['hash'] = Str::random(35);
        Voto::create($input);
        return redirect(route('votacao.votar'));
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
    public function minhasVotacoes()
    {
        $minhas = stdToArray(Votacao::select('id', 'name', 'descricao', 'gremista', 'inicio', 'termino', 'inicio_validacao', 'termino_validacao', 'status', 'created_at', 'updated_at')->where("user_id", Auth::user()->id)->get());
        if (!empty($minhas)) {
            $fireAlert = false;
        } else {
            $fireAlert = true;
        }
        return view('voto.minhas_votacoes', compact('minhas', 'fireAlert'));
    }

    public function validacao($id)
    {
        //Retorna a votação segundo o $id
        $votacao = Votacao::select("name", "inicio_validacao", "termino_validacao")->where('id', $id)->get();
        //Verifica se há votação com esse id e retorna para minhas votações caso não haja
        if ($votacao->isEmpty()) {
            return redirect(route('votacao.minhas'));
        }
        $votacao =  objToArray($votacao);


        //Verifica se está no período de validação
        if ($votacao['inicio_validacao'] <= Carbon::now() && $votacao['termino_validacao'] >= Carbon::now()) {
            //Retorna os votantes para validação caso a votação tenha terminado

            $votantes = stdToArray(Voto::select("votos.id", "users.name", "users.matricula", 'unidades.name as unidade', 'votacoes.name as votacao', 'votacoes.id as votacao_id')
                ->where("votacao_id", $id)->join('users', 'votos.user_id', '=', 'users.id')->join('unidades', 'users.unidade_id', '=', 'unidades.id')->join('votacoes', 'votos.votacao_id', '=', 'votacoes.id')->get());


            return view('voto.validacao_votacao', compact('votantes'));
        } else {
            return redirect(route('votacao.minhas'));
        }
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

        $votacao = Votacao::find($id);

        $votacao->status = $request->input('status');
        $votacao->save();
        return redirect(route('votacao.minhas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $input = $request->validate([
            'votante' => 'required|string|max:255',
            'justificativa' => 'required|string|max:500',
            'votacao_id'=>'required'


        ], [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi atingido",
        ]);
        $input['user_id'] = Auth::user()->id;
        
            Nulo::create($input);



        Voto::find($id)->delete();

        return (redirect(route('votacao.validacao')));
    }

    public function votantes($id)
    {

        $votacao = Votacao::select("name")->where('id', $id)->get();
        $votacao =  objToArray($votacao);
        $votantes = Voto::select("votos.id", "users.name", "users.matricula", 'unidades.name as unidade', 'votacoes.name as votacao', 'votacoes.id as votacao_id')
                ->where("votacao_id", $id)->join
                ('users', 'votos.user_id', '=', 'users.id')->join
                ('unidades', 'users.unidade_id', '=', 'unidades.id')
                ->join('votacoes', 'votos.votacao_id', '=', 'votacoes.id')->get();
 

        //Retorna o número de nulos
        $votosnulos = Nulo::select("votante", "users.name as name", "justificativa")->where('votacao_id', $id)->join('users', 'nulos.user_id', '=', 'users.id')->get();
        $pdf = new \App\Custom\Pdf\Oficio();
        $pdf->SetFont('LiberationSerif-Regular', 'R', 12);


        //Insere a view do cabeçalho no PDF
        $entidade = objToArray(Entidade::where('id', Auth::user()->entidade_id)->get());

        $unidade = objToArray(Unidade::where('id', $entidade['unidade_id'])->get());
        $gestao = Gestao::find(Auth::user()->gestao_id);
        $data['titulo'] = "Lista de votantes de " . $votacao['name'];
        $cab = view("pdf.components.cabecalho", compact(['data', 'unidade', 'entidade', 'gestao']));

 
        $pdf->AddPage();

        //Adiciona a logo com base no banco de dados

        $pdf->Image('storage/' . $entidade['logo'], 25, 19, 32, '', '', $entidade['instagram'], '', false, 150, '', false, false, 0, false, false, false);
        //Adiciona a logo do IF à esquerda
        $pdf->Image('storage/misc/Logo IFRN.jpg', 155, 14, 37, '', 'JPG', 'http://portal.ifrn.edu.br', '', false, 150, '', false, false, 0, false, false, false);

        // $pdf->writeHTML($cab, false, false, false, false, 'C');
        $pdf->WriteHTMLCell(111, 5, 50, 13, $cab, 0, 0, 0, 0, 'C');
        $pdf->Line(25, 50, 195, 50);

        $pdf->setCellHeightRatio(0.6);
        $pdf->SetFont('LiberationSerif-Bold', 'B', 12);

        $html = '
            <strong> ' . $votacao['name'] . '
            ';


        $pdf->writeHTMLCell(168, 30, 24, 52, $html, 0, 0, 0, '', false);

        $tbl = '<table border="1" cellpadding="3" cellspacing="0"  >
        <tr>
        <th colspan="3" align="center">Lista de votantes</th></tr>
        <tr nobr="true">
        <td width="30" align="center">Nº</td>
         
        <td width="180" align="center">Nome</td>
         
        <td width="180" align="center">Matrícula</td>
        <td  align="center">Unidade</td>
        </tr>';

        if ($votantes->isNotEmpty() == true) {
            $n = 0;

            foreach ($votantes as $v) {
                $n = $n + 1;
                $tbl .=  '
           

            <tr nobr="true">
 
  <td width="30" align="center">' . $n . '<br /></td>
  <td width="180">' . $v->name . '<br /></td>

 <td width="180" align="center">' . $v->matricula . '<br /></td>
 <td align="center">' . $v->unidade . '<br /></td>
</tr>';
            }
            $tbl .= "</table>";
        } else {
            $tbl = "Não há votantes cadastrados.";
        }


        $pdf->SetFont('LiberationSerif-Regular', 'R', 12);

        $nulos = ' <table border="1" cellpadding="3" cellspacing="0"  >
        <tr>
        <th colspan="3" align="center">Lista de votos anulados</th></tr>
        <tr nobr="true">
        <td width="30" align="center">Nº</td>
         
        <td width="80" align="center">Nome</td>
         
        <td width="80" align="center">Gremista</td>
        <td  align="center">Justificativa</td>
        </tr>';
        if ($votosnulos->isNotEmpty() == true) {
            $n = 0;

            foreach ($votosnulos as $v) {
                $n = $n + 1;
                $nulos .=  '
           

            <tr nobr="true">
 
  <td width="30" align="center">' . $n . '<br /></td>
  <td width="80">' . $v->votante . '<br /></td>

 <td width="80" align="center">' . $v->name . '<br /></td>
 <td align="center">' . $v->justificativa . '<br /></td>
</tr>';
            }

            $nulos .= "</table>";
        } else {
            $tbl = "Não há votantes cadastrados.";
        }
        $pdf->writeHTMLCell(178, 30, 24, 62, $tbl, 0, 0, 0, '', true);
        $pdf->AddPage();
      
        $pdf->writeHTMLCell(178, 30, 24, 50, $nulos, 0, 0, 0, '', false);
       
                 
  

 

        //Coloca a fonte novamente para Regular

        $pdf->setCellHeightRatio(K_CELL_HEIGHT_RATIO);
        //Retorna o pdf
        $t =  $data['titulo'] . ".pdf";
        $pdf->Output($t, 'I');
    }
}
