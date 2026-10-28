@extends('adminlte::page')

@section('title', 'Patrimônio')

@section('content_header')
    <h1>Listagem de patrimônio de todas as entidades</h1>
@stop

@section('content')
    @php
        // dd($patrimonio);
        $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Identificação', 'Observações',
        'Modo de Obtenção', 'Custo em R$', 'Emprestável', 'Gremista que cadastrou', 'Entidade'];

        $config = [
            'data' => [],
            'order' => [[1, 'asc']],
            'columns' => [['visible' => false], ['orderable' => true]],
        ];
        foreach ($patrimonio as $c) {
            //Verifica se é Adm para exibir o botão editar
                // $btnEditar =
                //     '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Editar patrimônio" type="submit"
                //                                         data-toggle="modal" data-target="#modal-editar-' .
                //     $c['id'] .
                //     '"class="bg-danger"  >
                //                             <i class="fas fa-edit"></i>                                       </a>';
 $config['data'][] = $c;
                // $c[] = $c;
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
    <script></script>
@stop
