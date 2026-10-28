@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Início</h1>
@stop

@section('content')

    {{-- Só será visível para quem estivar em gestão e em entidade --}}
    @if (isset(Auth::user()->gestao_id) && isset(Auth::user()->entidade_id) && Auth::user()->isAbleTo('tarefas-create'))
        <x-adminlte-card title="Quadro de Tarefas" theme="danger" icon="fas fa-lg fa-tasks" collapsible maximizable>
            <div class="row">
                <div class="col-sm">
                    <x-adminlte-card title="A fazer" theme="info" icon="fas fa-lg fa-bell" collapsible maximizable>
                        <div style="padding-right: 30%;padding-left:33%;margin-bottom:5%">
                            <x-adminlte-button label="Nova tarefa" data-toggle="modal" data-target="#modalTarefa"
                                class="bg-lime" />
                        </div>
                        {{-- Verifica se há tarefas a fazer --}}
                        @if ($afazer->isNotEmpty())

                            {{-- Foreach para imprimir as tarefas a fazer --}}
                            @foreach ($afazer as $a)
                                <x-adminlte-card theme="lime" theme-mode="outline">
                                    {{-- Seta para avançar para Em Progresso --}}

                                    <form action="{{ route('tarefas.update', $a->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <strong>Tarefa:<br></strong> {{ $a->name }}<br>
                                        <strong>Responsável:<br></strong>{{ $a->responsavel }}<br>
                                        <input hidden readonly name="coluna" value=2>
                                        <x-slot name="footerSlot">
                                            <x-adminlte-button type="submit" label="" theme="warning"
                                                icon="fas fa-arrow-right" />
                                    </form>
                                    <form style="display:inline-block;" action="{{ route('tarefas.delete', $a->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')

                                        <input hidden readonly name="coluna" value=1>
                                        <x-adminlte-button type="submit" label="" theme="danger"
                                            icon="fas fa-trash" />
                                    </form>
                                    </x-slot>
                                </x-adminlte-card>
                            @endforeach
                        @else
                            <div class="text-center"> Não há tarefas a fazer. </div>
                        @endif
                    </x-adminlte-card>
                </div>
                <div class="col-sm">
                    <x-adminlte-card title="Em progresso" theme="warning" icon="fas fa-lg fa-spinner" collapsible
                        maximizable>
                        @if ($emprogresso->isNotEmpty())

                            {{-- Foreach para imprimir as tarefas em progresso --}}
                            @foreach ($emprogresso as $g)
                                <x-adminlte-card theme="warning" theme-mode="outline">
                                    <strong>Tarefa:<br></strong> {{ $g->name }}<br>
                                    <strong>Responsável:<br></strong>{{ $g->responsavel }}<br>
                                    {{-- Seta para retornar para A fazer --}}

                                    <form class="ml-2" action="{{ route('tarefas.update', $g->id) }}" method="post">
                                        @csrf
                                        @method('put')

                                        <input hidden readonly name="coluna" value=3>
                                        <x-slot name="footerSlot">


                                            <x-adminlte-button type="submit" label="" theme="success"
                                                icon="fas fa-arrow-right" />

                                    </form>
                                    {{-- Seta para avançar para Concluído --}}

                                    <form style="display:inline-block;" action="{{ route('tarefas.update', $g->id) }}"
                                        method="post">
                                        @csrf
                                        @method('put')

                                        <input hidden readonly name="coluna" value=1>
                                        <x-adminlte-button type="submit" label="" theme="info"
                                            icon="fas fa-arrow-left" />
                                    </form>
                                    {{-- Botão de apagar --}}
                                    <form style="display:inline-block;" action="{{ route('tarefas.delete', $g->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')


                                        <x-adminlte-button type="submit" label="" theme="danger"
                                            icon="fas fa-trash" />
                                    </form>
                                    </x-slot>
                                </x-adminlte-card>
                            @endforeach
                        @else
                            <div class="text-center"> Não há tarefas em progresso. </div>
                        @endif
                    </x-adminlte-card>
                </div>
                <div class="col-sm">
                    <x-adminlte-card title="Concluído" theme="success" icon="fas fa-lg fa-check" collapsible maximizable>
                        {{-- Foreach para imprimir as tarefas concluídas --}}
                        @if ($concluido->isNotEmpty())
                            @foreach ($concluido as $c)
                                <x-adminlte-card theme="warning" theme-mode="outline">
                                    <strong>Tarefa:<br></strong> {{ $c->name }}<br>
                                    <strong>Responsável:<br></strong>{{ $c->responsavel }}<br>
                                    {{-- Seta para retornar para Em Progresso --}}
                                    <form style="display:inline-block;" action="{{ route('tarefas.update', $c->id) }}"
                                        method="post">
                                        @csrf
                                        @method('put')

                                        <input hidden readonly name="coluna" value=2>
                                        <x-adminlte-button type="submit" label="" theme="warning"
                                            icon="fas fa-arrow-left" />
                                    </form>
                                    {{-- Botão de apagar --}}
                                    <form style="display:inline-block;" action="{{ route('tarefas.delete', $c->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')

                                        <x-adminlte-button type="submit" label="" theme="danger"
                                            icon="fas fa-trash" />
                                    </form>
                                </x-adminlte-card>
                            @endforeach
                        @else
                            <div class="text-center"> Não há tarefas concluídas. </div>
                        @endif
                    </x-adminlte-card>
                </div>

        </x-adminlte-card>
        {{-- Modal para criação de uma nova tarefa --}}
        <x-adminlte-modal id="modalTarefa" title="Nova tarefa" theme="success" icon="fas fa-plus" v-centered static-backdrop
            scrollable>

            {{-- Formulário para criação da tarefa --}}
            <form method="post" action={{ route('tarefas.store') }}>
                @csrf
                @method('POST')
                <x-adminlte-input name="name" label="Nome da Tarefa" placeholder="Organizar o drive do grêmio">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="responsavel" label="Responsável" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text ">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>
                    {{-- Foreach com o pessoal da gestão --}}
                    @foreach ($gestao as $g)
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                    @endforeach
                </x-adminlte-select>


                <x-slot name="footerSlot">
                    <x-adminlte-button type="submit" class="mr-auto" theme="success" label="Criar tarefa" />
            </form>
            <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
            </x-slot>
        </x-adminlte-modal>

        <div class="card-body">
            <div id='calendar'></div>

        </div>

        {{-- Modal visulizar detalhes do evento --}}
        <div class="modal fade" id="visualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="visevent">
                            <dl class="row">
                                {{-- <dt class="col-sm-3">ID</dt> --}}
                                {{-- <dd class="col-sm-9" id="id"></dd> --}}
                                <dt class="col-sm-3">Título</dt>
                                <dd class="col-sm-9" id="title"></dd>
                                <dt class="col-sm-3">Início</dt>
                                <dd class="col-sm-9" id="start"></dd>
                                <dt class="col-sm-3">Término</dt>
                                <dd class="col-sm-9" id="end"></dd>
                            </dl>
                            <button class="btn btn-warning btn-canc-vis" style="display: inline-block">Editar</button>
                            {{-- <form action="{{route("eventos.delete")}}">
                            @csrf
                            @method("post")
                            <input type="text" hidden readonly name="id" class="form-control"
                                id="id" >
                            <button class="btn btn-danger" style="display: inline-block" type="submit">Apagar</button>

                        </form> --}}
                        </div>
                        <div class="formedit" id="formedit">
                            <form id="editEvent" action="{{ route('eventos.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="text" hidden readonly name="id" class="form-control"
                                            id="id">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title"
                                            placeholder="Título do evento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="color" class="col-sm-2 col-form-label">Cor</label>
                                    <div class="col-sm-10">
                                        <select name="color" class="form-control" id="color">
                                            <option value="">Selecione</option>
                                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                            <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                            <option style="color:#228B22;" value="#228B22">Verde</option>
                                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start" class="col-sm-2 col-form-label">Início</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="start" class="form-control" id="start"
                                            onkeypress="DataHora(event,this)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end" class="col-sm-2 col-form-label">Término</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="end" class="form-control" id="end"
                                            onkeypress="DataHora(event,this)">
                                    </div>
                                </div>

                                <button type="button"class="btn btn-primary btn-canc-edit">Cancelar</button>
                                <button type="submit" name="editEvento" id="editEvento" class="btn btn-success">Salvar
                                    evento</button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Modal de cadastrar evento --}}
        <div class="modal fade" id="cadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addEvent" action="{{ route('eventos.store') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" required name="title" class="form-control" id="title"
                                        placeholder="Título do evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="color" class="col-sm-2 col-form-label">Cor</label>
                                <div class="col-sm-10">
                                    <select required name="color" class="form-control" id="color">
                                        <option value="">Selecione</option>
                                        <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                        <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                        <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                        <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                        <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                        <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                        <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                        <option style="color:#228B22;" value="#228B22">Verde</option>
                                        <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="start" class="col-sm-2 col-form-label">Início</label>
                                <div class="col-sm-10">
                                    <input type="text"required name="start" class="form-control" id="start"
                                        onkeypress="DataHora(event,this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end" class="col-sm-2 col-form-label">Término</label>
                                <div class="col-sm-10">
                                    <input type="text" required name="end" class="form-control" id="end"
                                        onkeypress="DataHora(event,this)">
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="CadEvent" id="CadEvent" class="btn btn-success">Salvar
                            evento</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@stop

@section('css')
    <link href='{{ asset('vendor/fullcalendar/lib/main.css') }}' rel='stylesheet' />

@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Read flag from the controller.
            let shouldFire = @json($fireAlert);

            if (shouldFire) {
                Swal.fire('Success!', 'Boas-vindas!', 'success');
            }

        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='{{ asset('vendor/fullcalendar/lib/main.js') }}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('eventos.show') }}',
                locale: "pt-br",
                editable: false,
                eventLimit: true,
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                select: function(info) {
                    $('#cadastrar #start').val(info.start.toLocaleString());
                    $('#cadastrar #end').val(info.end.toLocaleString());
                    $('#cadastrar').modal('show');
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    $('#visualizar #id').text(info.event.id)
                    $('#visualizar #id').val(info.event.id)
                    $('#visualizar #title').text(info.event.title);
                    $('#visualizar #title').val(info.event.title);
                    $('#visualizar #start').text(info.event.start.toLocaleString());
                    $('#visualizar #start').val(info.event.start.toLocaleString());
                    $('#visualizar #end').text(info.event.end.toLocaleString());
                    $('#visualizar #end').val(info.event.end.toLocaleString());
                    $('#visualizar #color').val(info.event.backgroundColor);

                    $('#visualizar').modal('show')
                }
            });
            calendar.render();

        });

        function DataHora(evento, objeto) {
            var keypress = (window.event) ? event.keyCode : evento.which;
            campo = eval(objeto);
            if (campo.value == '00/00/0000 00:00:00') {
                campo.value = "";
            }

            caracteres = '0123456789';
            separacao1 = '/';
            separacao2 = ' ';
            separacao3 = ':';
            conjunto1 = 2;
            conjunto2 = 5;
            conjunto3 = 10;
            conjunto4 = 13;
            conjunto5 = 16;
            if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
                if (campo.value.length == conjunto1)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto2)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto3)
                    campo.value = campo.value + separacao2;
                else if (campo.value.length == conjunto4)
                    campo.value = campo.value + separacao3;
                else if (campo.value.length == conjunto5)
                    campo.value = campo.value + separacao3;
            } else {
                event.returnValue = false;
            }

        } // Botões da modal de editar
        $('.btn-canc-vis').on("click", function() {
            $(".visevent").slideToggle();
            $(".formedit").slideToggle();
        });
        $('.btn-canc-edit').on("click", function() {
            $(".formedit").slideToggle();
            $(".visevent").slideToggle();
        });
    </script>

@stop
