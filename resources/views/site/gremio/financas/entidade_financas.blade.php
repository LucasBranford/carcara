@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Finanças da Entidade</h1>
@stop

@section('content')
    @php

    //Tabela dos gestaos que a entidade não tem
    $heads = ['ID', 'Tipo', 'Modo de Pagamento', 'Valor', 'Participante', 'CPF do Participante', 'Gremista', 'CPF do Gremista', 'Criado em', 'Atualizado em'];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];

    foreach ($fin as $c) {
        //     $btnExibir =
        //         '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="s" type="submit"
        //                                                 data-toggle="modal" data-target="#modal-' .
        //         $c['id'] .
        //         '"class="bg-danger"  >
        //                                     <i class="fas fa-fin-plus"></i>                                       </a>';
        // $c[] = '<nobr>' . $btnExibir . '</nobr>';
        $config['data'][] = $c;
    }

    @endphp


   
       

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
