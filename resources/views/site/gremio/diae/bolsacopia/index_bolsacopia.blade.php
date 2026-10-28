@extends('adminlte::page')
@section('title', 'Bolsa Cópia')

@section('content_header')
    <h1>Bolsa Cópia</h1>
@stop

@section('content')
    @php
    //Realiza checagem se o usuário pode adicionar laudas a um registro para poder exibir a coluna "Botões"
    if (Auth::user()->isAbleTo('entidades-create')) {
        $heads = ['ID', 'Nome', 'Matrícula', 'Laudas', 'Gremista', 'Unidade de Ensino', '1ª Impressão', 'Última impressão', ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
    } else {
        $heads = ['ID', 'Nome', 'Matrícula', 'Laudas', 'Gremista', 'Unidade de Ensino', '1ª Impressão', 'Última impressão'];
    }
    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    @endphp


    @php

    foreach ($bolsas as $c) {
        if (Auth::user()->isAbleTo('entidades-create')) {
            $btnEditar =
                '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Adicionar Laudas" type="submit"
                                                                                            data-toggle="modal" data-target="#modal-bc-' .
                $c['id'] .
                '"class="bg-danger"  >
                                                                                <i class="fas fa-print"></i>                                       </a>';
            $c[] = '<nobr>' . $btnEditar . '</nobr>';
        } else {
            $btnEditar = '<a class="btn btn-xs btn-default text-success mx-1 shadow" disabled></a>';
        }
        $config['data'][] = $c;
    }
    @endphp

    @foreach ($bolsas as $g)
        {{-- --Modal para mostrar os membros da gestão --}}

        <x-adminlte-modal id="modal-bc-{{ $g['id'] }}" title="Registro de {{ $g['name'] }}" theme="purple"
            icon="fas fa-users" size='lg'>

            <x-adminlte-input required name="name" readonly disabled label="Nome do estudante" value="{{ $g['name'] }}"
                label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input required name="matricula" readonly disabled label="Matrícula" value="{{ $g['matricula'] }}"
                label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-id-card text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input required name="#" label="Laudas atuais" readonly disabled value="{{ $g['laudas'] }}"
                type="number" min="0" label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-print text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <form action="{{ route('bolsacopia.update',$g['id']) }}"  method="post">
                @csrf
                @method('POST')
                <x-adminlte-input required name="laudas" label="Laudas a adicionar" type="number" min="0"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-print text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
           








            <x-slot name="footerSlot">

                <x-adminlte-button theme="success" type="submit" label="Adicionar laudas" />
 </form>
              
                <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
            </x-slot>
        </x-adminlte-modal>
    @endforeach






    <!-- tabela-->

    <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" theme="light" striped hoverable with-buttons>

        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>




@stop

@section('css')
@stop

@section('js')

@stop
