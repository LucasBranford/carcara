@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Novo Ofício</h1>
@stop

@section('content')
    <div class='card-body'>
        <form action="{{ route('oficio.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')



            <div id="numeracao_ofc">

                <input readonly name="titulo" id="input-numeracao_ofc" type="text"
                    value="OFÍCIO Nº {{ num('ofc') }}/{{ strtoupper(siglaDir(Auth::user()->team_id) . '/' . siglaEnt(Auth::user()->entidade_id)) }}"
                    placeholder="OFÍCIO <ANO>.<NÚMERO>/<SIGLA DA DIRETORIA>/GEVP" required>



                <input hidden name="numeracao" readonly type="text" value="{{ num('ofc') }}" required>

            </div>


            <div id="data_ofc">
                <input id="input-dataOficio" value="cidade, {{ datadoc() }}" type="text"
                    placeholder="<Local>, <dia> de <mês> de <ano>." name="data" required>

            </div>

            <div id="enderecamento_ofc">
                <textarea required name="enderecamento" id="input-enderecamento_ofc" spellcheck="true" wrap="hard"></textarea>
            </div>


            <div id="assunto_ofc">
                <input readonly="true" disabled type="text" value="Assunto: " id="input-assunto_ofcB">
                <input required id="input-assunto_ofc" type="text"
                    placeholder="<Breve resumo do que será tratado no corpo do texto>" name="assunto" spellcheck="true">

            </div>

            <div id="corpo_ofc">
                <textarea required id="input-corpo_ofc" type="text" placeholder="Texto do ofício" name="corpo" spellcheck="true"></textarea>
            </div>

            <div id="fecho_ofc">
                <input required id="input-fecho_ofc" type="text" placeholder="<Atenciosamente>," name="fecho"
                    spellcheck="true">


            </div>

            <div id="autor_ofc">
                <input readonly required id="input-autor_ofc" type="text" placeholder="<NOME DO GREMISTA>"
                    value="{{ Auth::user()->name }}" name="autor">
                <input readonly required id="input-cargo_ofc" type="text" value="{{ cargo(Auth::user()->id) }}"
                    name="cargo" placeholder="cargo" spellcheck="true">
                <input readonly required name="matricula" id="input-matricula_ofc" type="text"
                    value="{{ Auth::user()->matricula }}" placeholder="Matrícula">
            </div>





            <div class="card border-purple mb-3 p-auto"
            style="min-width:11rem;max-width: 11rem;" id="input-cardOfc">
                <div class="card-body text-purple" style="text-align: center">
                    <p class="card-text font-weight-bold text-lg">Ofício terminado?</p>
                    <p class="card-text text-sm">Lembre-se: documentos só valem quando assinados</p>
                    <input type="submit" class="btn btn-success" value="Salvar rascunho">
                </div>
            </div>


    </form>






@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/documentos.css') }}">

@stop



@section('js')


    <script>
        $(function() {
            CKEDITOR.replace('input-corpo_ofc', {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='



            });


        });
    </script>
@stop
