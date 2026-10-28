@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Nova Ata</h1>
@stop

@section('content')
    <div class="card">
        <div class='card-body'>

            <form action="{{ route('ata.update',$ata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
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
                    <div class="form-group ata-div">
                         
                        <label for="data_reuniao">Data da reunião</label>

                        <input class="form-control" name="data_reuniao" class="data_reuniao"
                            value="{{ $ata->data_reuniao }}"type="text" placeholder="Mossoró, 08 de maio de 2021.">
                        <label for="local">Local da reunião:</label>

                        <input class="form-control" name="local" value="{{ $ata->local }}" id="local" type="text"
                            placeholder="Plataforma Virtual Google Meet">
                        <label for="horario">Horários inicial e final</label>

                        <input class="form-control" name="horario_reuniao" id="horario"
                            value="{{ $ata->horario_reuniao }}" type="text" placeholder="15h às 18h35">
                    </div>

                    <div class="form-group ata-div">
                        <label for="convocacao">Convocação</label><Br>
                        <input name="convocacao" id="convocacao" type="text" value="{{ $ata->convocacao }}"
                            placeholder="<Nome Complete>, <Cargo>">
                        <Br>
                        <label for="tipo">Tipo da reunião:</label>

                        <select class="form-control" name="tipo" id="tipo">
                            <option selected="selected">Selecione o tipo</option>
                            <option value="Deliberativa" >Deliberativa</option>
                            <option value="Informativa">Informativa</option>
                        </select>

                        <label for="input-sec">Secretaria</label><Br>
                        <input class="form-control" name="secretaria" id="input-sec" value="{{ $ata->secretaria }}"
                            type="text" placeholder="Karydja França, Presidente do Grêmio">
                    </div>

                    <div class="form-group ata-div">
                        <label for="input-pautas">Pautas</label><Br>
                        <textarea name="pautas" required id="input-pautas" type="text" spellcheck="true"
                            placeholder="1. <nome da pauta>;       2. <nome da pauta>;">{{ $ata->pautas }}</textarea><Br>



                        <label for="input-enc">Encaminhamentos</label><br>

                        <textarea name="encaminhamentos" required id="input-enc" type="text" spellcheck="true"
                            placeholder='1. <nome do encaminhamento>; &#10Prazo: <prazo> &#10Responsável(eis): &#10Exemplo: 
                                1. Reunir-se com a DIAC;&#10Prazo: até 15/02/2021;&#10Responsável(eis): 
                                Marcos Batista de Souza.'>{{ $ata->encaminhamentos }}</textarea>
                        <br>
                        <label for="input-enc">Presentes</label><br>
                        <textarea name="presentes" required id="input-presentes" type="text" spellcheck="true"
                            placeholder='1. <nome completo> - <instância> - <matrícula> - <e-mail>; &#10Exemplo:&#10 1.
                                 Eduardo Marinho de Paiva - DIAES/GEVP - 201710240100025 - email@email.com;&#10 2. 
                                 Lucas Felipe Carlos do Nascimento -  REGIF - 20171024010009 - email@email.com;'>{{ $ata->presentes }}
                                </textarea>

                    </div>

                </div>
                <div style="margin:10mm 0 5mm 122mm">

                    <input type="text" name="titulo" style="width:45%"value="{{ $ata->titulo }}">

                </div>

                <div class="mt-0 ml-5">

                    <input class="form-control" style="margin-left: auto;margin-right:auto;text-align: center; width:30%"
                        name="autor" required id="input-autor" type="text" placeholder="<NOME DO GREMISTA>"
                        value="{{ Auth::user()->name }}" readonly>

                    <input class="form-control" style="margin-left: auto;margin-right:auto;text-align: center; width:30%"
                        name="matricula" id="input-matricula" type="text" value="{{ Auth::user()->matricula }}"
                        readonly>

                    <input class="form-control" style="margin-left: auto;margin-right:auto;text-align: center; width:30%"
                        required id="input-cargo" readonly type="text" value="{{ cargo(Auth::user()->id) }}"
                        name="cargo" spellcheck="true">

                    {{-- <label class="form-control" for="assinaturas" style='
                    margin-left: auto;margin-right:auto;text-align: center; color: black; font-weight: bold;width:30%'>
                        Anexo da Lista de Assinaturas:</label>
                    <input class="form-control" name="assinaturas" type="file" required="true"
                        style="margin-left: auto;margin-right:auto;text-align: center; width:30%">
                </div> --}}
                    <div class="m-5">

                        <label for="input-texto">Corpo do texto
                        </label>
                        <textarea name="corpo" required id="input-texto" type="text" spellcheck="true">{{ $ata->corpo }}</textarea>
                    </div>
                    <div class="card border-danger mb-3"
                        style="min-width:12rem;max-width: 18rem;position: relative;margin-right:auto;margin-left:auto;"
                        id="input-card">
                        <div class="card-body text-danger">
                            <h5 class="card-title">Terminou a ata? </h5>
                            <p class="card-text">Lembre-se:<br>Documentos só valem após assinados!</p>
                            <input type="submit" class="btn btn-danger" value="Salvar ata">
                        </div>
                    </div>
            </form>

        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/documentos.css') }}">

    @stop



    @section('js')
        <script>
            $(document).ready(function() {
                // Read flag from the controller.
                let shouldFire = @json($fireAlert);

                if (shouldFire) {
                    Swal.fire('Opa!',
                        'Você não está cadastrado em nenhuma entidade e/ou em uma gestão. Por favor, contate a administração',
                        'danger');
                }

            });
        </script>

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
