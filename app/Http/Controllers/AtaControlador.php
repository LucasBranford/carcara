<?php

namespace App\Http\Controllers;

use App\Models\Ata;
use App\Models\Entidade;
use App\Models\Gestao;
use App\Models\Oficio;
use App\Models\Portaria;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


//Este é o controlador de Atas. Ele é responsável por criar, editar, atualizar, imprimir e assinar atas. Além disso,
// ele também é responsável por verificar a autenticidade das atas assinadas.

class AtaControlador extends Controller
{
    //
    public function create()
    {
        //Verifica se o usuario está ligado a uma entidade
        if (isset(Auth::user()->entidade_id) && isset(Auth::user()->gestao_id)) {
            $fireAlert = false;
            //Retorna dados da entidade e da unidade para preenchimento do cabeçalho
            $entidade = Entidade::find(Auth::user()->entidade_id);
            $unidade = Unidade::find(Auth::user()->unidade_id);
            return view("site.documentos.ata.criar_ata", compact('entidade', 'unidade', 'fireAlert'));
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
            return view("site.documentos.documentos", compact('ata', 'ofc', 'port', 'fireAlert'));
        }
    }


    public function store(Request $request)
    {
        //
        $input = $request->validate([
            'numeracao' => 'required|string|max:255',
            'temporalidade' => 'required|string|max:255 ',
            'tipo' => 'required|string|max:255 ',
            'convocacao' => 'required|string|max:255',
            'secretaria' => 'required|string|max:255 ',
            'orgao' => 'required|string|max:255 ',
            'data_reuniao' => 'required|string|max:255',
            'horario_reuniao' => 'required|string|max:255 ',
            'local' => 'required|string|max:255 ',
            'pautas' => 'required| ',
            'encaminhamentos' => 'required| ',
            'presentes' => 'required|  ',
            'corpo' => 'required|',

        ], [
            'required' => "Este campo é obrigatório.",


        ]);
        $input['titulo'] = 'Ata de Reunião ' . $input['numeracao'] . ' ' . $input['temporalidade'] . ' - ' . $input['orgao'];
        $input['autor'] = Auth::user()->name;
        $input['matricula'] = Auth::user()->matricula;
        $input['cargo'] = cargo(Auth::user()->id);
        $input['entidade_id'] = Auth::user()->entidade_id;
        $input['gestao_id'] = Auth::user()->gestao_id;

        Ata::create($input);
        return (redirect(route("documentos.meus")));
    }

    public function edit($id)
    {
        //

        $ata = Ata::find($id);
        if ($ata->hash) {
            return (redirect(route('ata.criar')));
        } else {
            $fireAlert = false;


            return view("site.documentos.ata.editar_ata", compact('ata', 'fireAlert'));
        }
    }
    public function update(Request $request, $id)
    {
        //
        if (isset($request)) {
            $ata = Ata::find($id);
            if ($ata->hash) {
            } else {
                $input = $request->validate([
                    'titulo' => 'required|string|max:255 ',
                    'convocacao' => 'required|string|max:255',
                    'secretaria' => 'required|string|max:255 ',
                    'tipo' => 'required|string|max:255 ',
                    'data_reuniao' => 'required|string|max:255',
                    'horario_reuniao' => 'required|string|max:255 ',
                    'local' => 'required|string|max:255 ',
                    'pautas' => 'required| ',
                    'encaminhamentos' => 'required| ',
                    'presentes' => 'required|  ',
                    'corpo' => 'required|',




                ], [
                    'required' => "Este campo é obrigatório.",


                ]);



                $ata->titulo = $request->input('titulo');
                $ata->convocacao = $request->input('convocacao');
                $ata->secretaria = $request->input('secretaria');
                $ata->tipo = $request->input('tipo');
                $ata->data_reuniao = $request->input('data_reuniao');
                $ata->horario_reuniao = $request->input('horario_reuniao');
                $ata->local = $request->input('local');
                $ata->pautas = $request->input('pautas');
                $ata->encaminhamentos = $request->input('encaminhamentos');
                $ata->presentes = $request->input('presentes');
                $ata->corpo = $request->input('corpo');




                $ata->save();
            }
        }
        return redirect(route('documentos.meus'));
    }

    public function imprimir($id)
    {
        //Retorna a Ata pelo ID

        $ata = Ata::where('id', $id)->get();

        $data = objToArray($ata);
        //Retorna o id unidade da ata
        //Retorna toda a entidade da ata pelo ID
        $entidade = objToArray(Entidade::where('id', $data['entidade_id'])->get());


        //Retorna a unidade para colocar no cabeçalho
        $unidade = objToArray(Unidade::where('id', $entidade['unidade_id'])->get());
        //Retorna a gestão para colocar no cabeçalho
        $gestao = Gestao::find(Auth::user()->gestao_id);

        $pdf = new \App\Custom\Pdf\Documento(
            unit: \Com\Tecnick\Pdf\Page\Unit::Millimeter,
            isunicode: true,
            subsetfont: false,
            compress: true,
            mode: \Com\Tecnick\Pdf\PdfConformance::None,
            objEncrypt: null,
            fileOptions: [/* allowedPaths, como no AtaPdfService */],
        );

        // Equivale ao SetTopMargin(35). Eu defini PB/CB = 25 mm para o corpo não invadir o rodapé de 20 mm.
        $pdf->addPage([
            'format'      => 'A4',
            'orientation' => 'P',
            'autobreak'   => true,
            'margin'      => ['PT' => 35, 'PB' => 25, 'CT' => 35, 'CB' => 25],
        ]);
        $fonte = $pdf->font->insert($pdf->pon, 'liberationserif', '', 12);
        $pdf->page->addContent($fonte['out']);
        // ... corpo da ata com addHTMLCell(posx: 24, width: 166, ...) ...

        $pdf->Rodape();
        $raw = $pdf->getOutPDFString();
        // $pdf->SetFont('Liberation Serif', 'R', 12);


        $pdf->renderPDF(rawpdf: $raw);
    }


    public function assinar($id)
    {

        $ata = Ata::find($id);

        $ata->hash = Str::random(10);
        $ata->assinado = now();
        $ata->save();
        return redirect(route('documentos.meus'));
    }

    public function verificar()
    {
        return view('site.documentos.oficio.verificar');
    }

    public function verificando(Request $request)
    {
        if (isset($request)) {

            $ata = Ata::where('id', '=', $request->codigo_verificacao)->where('hash', '=', $request->codigo_autenticacao)->get();

            if (!$ata->isEmpty()) {
                return redirect(route('oficio.imprimir', $request->codigo_verificacao));
            } else {
                abort(404);
            }
        }
    }
}
