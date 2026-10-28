@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Nova Ata</h1>
@stop

@section('content')
    {{-- <div class="card"> --}}
    <div class='card-body'>

        <form action="{{ route('ata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="margin-left:auto;margin-right:auto;width:33%">
                <div class="form-group ">
                    <label for="num">Numeração</label>
                    <input class="form-control" name="numeracao" required id="num" type="text" placeholder=""
                        value="{{ num('ata') }}" readonly>
                    <br>
                    <label for="data_reuniao">Data da reunião</label>

                    <input class="form-control" name="data_reuniao" class="data_reuniao" type="text"
                        placeholder="Mossoró, 08 de maio de 2021.">
                    <br>

                    <label for="local">Local da reunião:</label>

                    <input class="form-control" name="local" id="local" type="text"
                        placeholder="Plataforma Virtual Google Meet">
                    <br>

                    <label for="horario">Horários inicial e final</label>

                    <input class="form-control" name="horario_reuniao" id="horario" type="text"
                        placeholder="15h às 18h35">
                    <br>


                    <label for="convocacao">Convocação</label>
                    <input class="form-control" name="convocacao" id="convocacao" type="text"
                        placeholder="<Nome Completo>, <Cargo>">
                    <br>
                    <label for="tipo">Tipo da reunião:</label>

                    <select class="form-control" name="tipo" id="tipo">
                        <option value="Deliberativa" selected="selected">Deliberativa</option>
                        <option value="Informativa">Informativa</option>
                    </select>
                    <br>

                    <label for="input-sec">Secretaria</label>
                    <input class="form-control" name="secretaria" id="input-sec" type="text"
                        placeholder="Karydja França, Presidente do Grêmio">
                    <br>

                    <label for="input-pautas">Pautas</label>
                    <textarea class="form-control" name="pautas" required id="input-pautas" type="text" spellcheck="true"
                        placeholder="1. <nome da pauta>;       2. <nome da pauta>;"></textarea>
                    <br>

                    <label for="input-enc">Encaminhamentos</label>
                    <textarea class="form-control" style=" white-space: pre-line " name="encaminhamentos" required id="input-enc"
                        type="text" spellcheck="true"
                        placeholder='1. <nome do encaminhamento>; &#10Prazo: <prazo> &#10Responsável(eis): &#10Exemplo:
                                 1. Reunir-se com a DIAC;&#10Prazo: até 15/02/2021;&#10Responsável(eis):
                                  Marcos Batista de Souza.'></textarea>
                    <br>

                    <label for="input-enc">Presentes</label>
                    <textarea class="form-control" name="presentes" required id="input-presentes" type="text" spellcheck="true"
                        placeholder='1. <nome completo> - <instância> - <matrícula> - <e-mail>; &#10Exemplo:&#10 1. Eduardo Marinho de Paiva - DIAES/GEVP - 201710240100025 - email@email.com;&#10 2. Lucas Felipe Carlos do Nascimento -  REGIF - 20171024010009 - email@email.com;'></textarea> </textarea>
                    <br>

                    <label for="orgao">Órgão</label>
                    <select class="form-control" name="orgao" style="font-size:15;">
                        <option value="CRT">CRT</option>
                        <option value="CRC">CRC</option>
                        <option value="Gestão">Gestão</option>
                        <option value="Reunião Externa">Reunião externa</option>
                    </select>
                    <br>

                    <label for="temporalidade">Temporalidade</label>
                    <select class="form-control" name="temporalidade" style="font-size:15;">
                        <option value="Ordinária"> Ordinária </option>
                        <option value="Extrardinária"> Extraordinária </option>
                    </select>
                    <br>
                    <label for="autor">Autoria</label>
                    <input class="form-control" style="text-align: center;
                 " name="autor" required
                        id="input-autor" type="text" placeholder="<NOME DO GREMISTA>" value="{{ Auth::user()->name }}"
                        readonly>

                    <br>
                    <label for="matricula">Matrícula</label>
                    <input class="form-control" style="text-align: center;
                " name="matricula"
                        id="input-matricula" type="text" value="{{ Auth::user()->matricula }}" readonly>
                    <br>

                    <label for="cargo">Cargo</label>
                    <input class="form-control" style="text-align:
                center; " required id="input-cargo"
                        readonly type="text" value="{{ cargo(Auth::user()->id) }}" name="cargo" spellcheck="true">
                    <br>

                    {{-- <label class="form-control" for="assinaturas" style='
                    text-align: center; color: black; font-weight: bold;width:30%'>
                        Anexo da Lista de Assinaturas:</label>
                    <input class="form-control" name="assinaturas" type="file" required="true"
                        style="text-align: center; width:30%"> --}}
                </div>
            </div>
            <div class="corpo-ata ">

                <label for="input-texto">Corpo do texto</label>
                <textarea name="corpo" required id="input-texto" type="text" spellcheck="true"></textarea>
            </div>
            <div class="card border-danger mb-3"
                style="min-width:12rem;max-width: 18rem;position: relative;
                    margin-top: -120px;
                    margin-left: 830px;
                    position: relative;
                    padding-left: auto;"
                id="input-card">
                <div class="card-body text-danger">
                    <h5 class="card-title">Terminou a ata? </h5>
                    <p class="card-text">Lembre-se:<br>Documentos só valem após assinados!</p>
                    <input type="submit" class="btn btn-danger" value="Salvar ata">
                </div>
            </div>
        </form>

        {{-- </div> --}}
    @stop

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/documentos.css') }}">

    @stop



    @section('js')

        <script>
            $(function() {
                CKEDITOR.replace('corpo', {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='



                });


            });
        </script>
    @stop
