@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Novo Ofício</h1>
@stop

@section('content')

    <form action="{{ route('oficio.update',$ofc->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!--<div id="gestao_ofc">
                                                                           
                    <input id ="input-gestao" type="text" placeholder="Gestão 2019.2021 - IF Para Tempos de Guerra" name="gestao_ofc" required>
                                                                            </div>
                                                                      
                                                                        -->



        <div id="numeracao_ofc">

            <input readonly name="titulo_ofc" id="input-numeracao_ofc" type="text"
                value="{{$ofc->titulo}}"
                placeholder="OFÍCIO <ANO>.<NÚMERO>/<SIGLA DA DIRETORIA>/GEVP" required>



            <input hidden name="numeracao_ofc" readonly type="text" value="{{$ofc->numeracao}}" required>

        </div>


        <div id="data_ofc">
            <input id="input-dataOficio" value="<cidade>, {{ $ofc->data}}" type="text"
                placeholder="<Local>, <dia> de <mês> de <ano>." name="data_ofc" required>

        </div>

        <div id="enderecamento_ofc">
            <textarea required name="enderecamento_ofc" id="input-enderecamento_ofc" spellcheck="true"
                wrap="hard">{{$ofc->enderecamento}}</textarea>
        </div>


        <div id="assunto_ofc">
            <input readonly="true"  type="text" value="Assunto: " id="input-assunto_ofcB">
            <input required id="input-assunto_ofc" value ="{{$ofc->assunto}}" type="text"
                placeholder="<Breve resumo do que será tratado no corpo do texto>" name="assunto_ofc" spellcheck="true">

        </div>

        <div id="corpo_ofc">
            <textarea required id="input-corpo_ofc" type="text" placeholder="Texto do ofício" name="corpo_ofc"
                spellcheck="true">{{$ofc->corpo}}</textarea>
        </div>

        <div id="fecho_ofc">
            <input required id="input-fecho_ofc" value = "{{$ofc->fecho}}" type="text" placeholder="<Atenciosamente>," name="fecho_ofc"
                spellcheck="true">


        </div>

        <div id="autor_ofc">
            <input readonly required id="input-autor_ofc" type="text" placeholder="<NOME DO GREMISTA>"
                value="{{ $ofc->autor }}" name="autor_ofc">
            <input readonly required id="input-cargo_ofc" type="text"                 name="cargo_ofc" value = "{{$ofc->cargo}}" placeholder="cargo" spellcheck="true">
            <input readonly required name="matricula_ofc" value = "{{$ofc->matricula}}" id="input-matricula_ofc" type="text"
                value="{{ Auth::user()->matricula }}" placeholder="Matrícula">
        </div>





        <div class="card border-purple mb-3 p-auto" style="min-width:11rem;max-width: 11rem;" id="input-cardOfc">
            <div class="card-body text-purple" style="text-align: center">
                <p class="card-text font-weight-bold text-lg">Ofício terminado?</p>
                <p class="card-text text-sm">Lembre-se: documentos só valem quando assinados</p>
                <input type="submit" class="btn btn-success" value="Salvar rascunho">
            </div>
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
