<?php

namespace App\Http\Controllers;

use App\Models\Ata;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Oficio;
use App\Models\Entidade;
use App\Models\Gestao;
use App\Models\Portaria;
use PDF;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpToken;
use QRcode as GlobalQRcode;
use Illuminate\Support\Str;


class OficioControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Verifica se o usuario está ligado a uma entidade
        if (isset(Auth::user()->entidade_id) && isset(Auth::user()->gestao_id)) {
            //Retorna dados da entidade para preenchimento do cabeçalho
            $entidade = Entidade::find(Auth::user()->entidade_id);
            $unidade = Unidade::find(Auth::user()->unidade_id);
            $gestao = Gestao::find(Auth::user()->gestao_id);
            return view("site.documentos.oficio.criar_oficio", compact('entidade', 'unidade', 'gestao'));
        } else {
        // Esse else será ativado caso alguém com permissão para tal tente fazer um documento sem estar numa entidade ou numa gestão

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
              return view("site.documentos.documentos", compact('ata','ofc','port', 'fireAlert'));
          }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Função para verificar a numeração

    //Função para transformar a entidade, a numeração e o assunto em título
    public function store(Request $request)
    {
        //
        $input = $request->validate([
            'titulo' => 'required|string|max:255|unique:oficios',
            'numeracao' => 'required|string|max:255|unique:oficios',
            'data' => 'required|string|max:255',
             'enderecamento' => 'required|string|max:255 ',
            'assunto' => 'required|string|max:255 ',
            'corpo' => 'required|string',
            'fecho' => 'required|string|max:255 ',
            'autor' => 'required|string|max:255 ',
            'matricula' => 'required|string|max:255 ',
            'cargo' => 'required|string|max:255 ',


        ], [
            'required' => "Este campo é obrigatório.",
            'unique' => "Já há uma gestão com esse nome.",
         ]);


        $input['entidade_id'] = Auth::User()->entidade_id;
        $input['gestao_id'] = Auth::User()->gestao_id;

        Oficio::create($input);

        //             $ofc = new Oficio;

        //             $ofc->entidade_id = Auth::User()->entidade_id;          // var_dump($request->input('corpo_ofc'));exit;



        //             $ofc->titulo = $request->input('titulo');
        //             $ofc->data = $request->input('data');

        //             $ofc->numeracao = $request->input('numeracao');
        //             $ofc->enderecamento = $request->input('enderecamento');
        //             $ofc->assunto = $request->input('assunto');
        //             $ofc->corpo = $request->input('corpo');
        //             $ofc->fecho = $request->input('fecho');
        //             $ofc->autor = $request->input('autor');
        //             $ofc->matricula = $request->input('matricula');
        //             $ofc->cargo = $request->input('cargo');

        // dd($ofc);


        // $ofc->save();

        return redirect(route('documentos'));
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
        $ofc = Oficio::find($id);

        if ($ofc->autor == Auth::user()->name) {
            if ($ofc->hash) {
                return redirect(route('documentos.meus'));

            } else {

                return view("site.documentos.oficio.editar_oficio", compact('ofc'));
            }
        } else {
            return redirect(route('documentos.meus'));
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
        if (isset($request)) {
            $ofc = Oficio::find($id);
            //Este if verifica se o ofício já possui o campo hash, ou seja, se já foi assinado. Se já tiver sido, ele não fará nada
            //além de redirecionar para documentos, caso contrário ele editará o registro no banco de dados
            if ($ofc->autor == Auth::user()->name) {

                if ($ofc->hash) {
                } else {



                    $ofc->data = $request->input('data_ofc');

                    $ofc->numeracao = $request->input('numeracao_ofc');
                    $ofc->enderecamento = $request->input('enderecamento_ofc');
                    $ofc->assunto = $request->input('assunto_ofc');
                    $ofc->corpo = $request->input('corpo_ofc');
                    $ofc->fecho = $request->input('fecho_ofc');
                    $ofc->autor = $request->input('autor_ofc');
                    $ofc->matricula = $request->input('matricula_ofc');
                    $ofc->cargo = $request->input('cargo_ofc');




                    $ofc->save();
                }
            }
        }
        return redirect(route('documentos.meus'));
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

    public function imprimir($id)
    {
        //Retorna o ofício pelo ID

        $ofc = Oficio::where('id', $id)->get();

        $data = objToArray($ofc);
        //Retorna o id unidade do Ofício
        //Retorna toda a entidade do ofício pelo ID
        $entidade = objToArray(Entidade::where('id', $data['entidade_id'])->get());
        //Retorna toda a gestão do ofício pelo ID
        $gestao = objToArray(Gestao::where('id', $data['gestao_id'])->get());
        //Retorna a unidade para colocar no cabeçalho
        $unidade = objToArray(Unidade::where('id', $entidade['unidade_id'])->get());


        //Inicia o PDF
        $pdf = new \App\Custom\Pdf\Documento();
        $pdf->SetFont('Liberation Serif', 'R', 12);


        //Insere a view do cabeçalho no PDF
        $cab = view("pdf.components.cabecalho", compact(['data', 'unidade', 'entidade', 'gestao']));

        $corpo = view("pdf.components.corpo", compact(['data', 'unidade', 'entidade']));
        //Retira o Header e o Footer orignal do TCPDF

        $pdf->AddPage();

        //Adiciona a logo com base no banco de dados

      //  $pdf->Image('storage/' . $entidade['logo'], 25, 19, 32, '', '', $entidade['instagram'], '', false, 150, '', false, false, 0, false, false, false);
        //Adiciona a logo do IF à esquerda
      //  $pdf->Image('storage/misc/Logo IFRN.jpg', 155, 14, 37, '', 'JPG', 'http://portal.ifrn.edu.br', '', false, 150, '', false, false, 0, false, false, false);

        // $pdf->writeHTML($cab, false, false, false, false, 'C');
        $pdf->WriteHTMLCell(111, 5, 50, 13, $cab, 0, 0, 0, 0, 'C');
        $pdf->Line(25, 50, 195, 50);

        $pdf->setCellHeightRatio(0.6);
        $pdf->SetFont('Liberation Serif', 'B', 12);

        $html = '
            <b>' . $data['titulo'] . '</b>
            <p style="margin-top: 0px" align = "right">' . $data['data'] . '</p>
           ';


        $pdf->writeHTMLCell(168, 30, 24, 52, $html, 0, 0, 0, '', false);
        //Coloca a fonte novamente para Regular
        $pdf->SetFont('Liberation Serif', 'R', 12);
        $pdf->setCellHeightRatio(K_CELL_HEIGHT_RATIO);
        $pdf->MultiCell(170, '', $data['enderecamento'], 0, 'L', 0, 1, 24, 60, true, 0, false, true, 0, 'B');
        $pdf->Ln(5); //pula 1cm
        $pdf->SetFont('Liberation Serif', 'B', 12);

        $html = '<b>Assunto: ' . $data['assunto'] . '</b><br>';
        $pdf->writeHTMLCell(168, '', 23, '', $html, 0, 1, 0, true, 'J', true);
        //Coloca a fonte novamente para Regular
        $pdf->SetFont('Liberation Serif', 'R', 12);
        $pdf->writeHTMLCell(168, '', 23, '', $data['corpo'], 0, 2, 0, true, 'J', true); // o eixo y está maior para ficar alinhado com as logos
        //Rodapé

        $corpo = view("pdf.components.corpo", compact(['data', 'unidade', 'entidade']));

        $pdf->writeHTMLCell(168, '', 23, '', '<br><br>' . $data['fecho'], 0, 2, 0, true, 'J', true); // o eixo y está maior para ficar alinhado com as logos

        $pdf->writeHTMLCell(168, '', 23, '', strToUpper($data['autor']), 0, 2, 0, true, 'C', true); // o eixo y está maior para ficar alinhado com as logos
        $pdf->writeHTMLCell(168, '', 23, '', $data['cargo'], 0, 2, 0, true, 'C', true); // o eixo y está maior para ficar alinhado com as logos
        $pdf->writeHTMLCell(168, '', 23, '', $data['matricula'], 0, 2, 0, true, 'C', true); // o eixo y está maior para ficar alinhado com as logos

        $certificate = 'file://' .  realpath('/xampp/sites/carcara/tcpdf.crt');

        // set additional information
        $info = array(
            'Name' => $data['autor'],
            'Location' => "https://www.carcara.org.br",
            'Reason' => $data['titulo'],
            'ContactInfo' => $entidade['email'],
        );
        $pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);


        //Verifica se já foi assinado, ou seja, se já há algo na coluna hash da tabela oficios
        $ofc = Oficio::find($id);
        if (!empty($ofc->hash)) {


            //estilo do QRCode
            $style = array(
                'border' => 2,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            //Separa os 10 primeiros caracteres do hashcode
            $hash = substr($ofc->hash, 0, 10);
            //Escreve o QRCode. O código de verificação é o ID do ofício e o de autenticação é o hash
            $pdf->write2DBarcode(route('oficio.verificando', ['codigo_verificacao' => $ofc->id, 'codigo_autenticacao' => $hash]), 'QRCODE,L', 150, '', 40, 40, $style, 'N');


            $assinatura = "Este documento foi assinado em " .  $ofc->assinado . ". Para verificar sua autenticidade, visite a página de verificação: " . route('oficio.verificar')
                . " e insira os seguinte códigos: <BR>Código de Verificação: " . $ofc->id . " <br>Código de Autenticação: " . $hash;
            $pdf->writeHTMLCell(168, '', 23, '',  $assinatura, 1, 2, 0, true, 'J', true); // o eixo y está maior para ficar alinhado com as logos
            $pdf->SetFont('Liberation Serif', 'R', 12);
        }





        //Retorna o pdf
        $pdf->Output(titulodoc($data['titulo']) . ".pdf", 'I');
    }

    public function assinar($id)
    {

        $ofc = Oficio::find($id);

        $ofc->hash = Str::random(10);
        $ofc->assinado = now();
        $ofc->save();
        return redirect(route('documentos.meus'));
    }

    public function verificar()
    {
        return view('site.documentos.oficio.verificar');
    }

    public function verificando(Request $request)
    {
        if (isset($request)) {

            $ofc = Oficio::where('id', '=', $request->codigo_verificacao)->where('hash', '=', $request->codigo_autenticacao)->get();

            if (!$ofc->isEmpty()) {
                return redirect(route('oficio.imprimir', $request->codigo_verificacao));
            } else {
                abort(404);
            }
        }
    }
}
