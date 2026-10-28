@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Todas as movimentações</h1>
@stop

@section('content')
    @php

    //Tabela dos gestaos que a entidade não tem
    $heads = ['ID', ['label' => 'Entidade', 'width' => 10],'Identificação', 'Tipo', 
    'Modo de Pagamento', 
    'Valor', 'Participante','Gremista', 'Criado em','Atualizado em'];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
        
    ];
   
     foreach ($fin as $c) {
    //     $btnExibir =
    //         '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Adicionar Permissões" type="submit"
    //                                                 data-toggle="modal" data-target="#modal-gestao-' .
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
