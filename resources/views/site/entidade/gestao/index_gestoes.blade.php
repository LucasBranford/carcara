@extends('adminlte::page')

@section('title', 'Gestões')

@section('content_header')
    <h1>Listagem de Gestões Ativas</h1>
@stop

@section('content')
    @php
        //Tabela dos gestaos que a entidade não tem
        $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Entidade', 'Provisória', 'Ativa', 'Início', 'Término', 'Criado em', 'Ata de Posse', ['label' => 'Ações', 'no-export' => true, 'width' => 5]];

        $config = [
            'data' => [],
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];

        foreach ($gestoes as $c) {
            $c['atadeposse'] =
                '<a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Ata de Posse"
                                    href="' .
                asset('storage/' . $c['atadeposse']) .
                '" .

                            "class="bg-danger"  >
                                <i class="fas fa-book"></i>                                       </a>';

            $btnExibir =
                '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Membros da Gestão" type="submit"
                                            data-toggle="modal" data-target="#modal-gestao-' .
                $c['id'] .
                '"class="bg-danger"  >
                                <i class="fas fa-users"></i>                                       </a>';
            $c[] = '<nobr>' . $btnExibir . '</nobr>';
            $config['data'][] = $c;
        }

    @endphp

    @foreach ($gestoes as $g)
        {{-- --Modal para mostrar os membros da gestão --}}

        <x-adminlte-modal id="modal-gestao-{{ $g['id'] }}" title="Gestão {{ $g['name'] }}" theme="purple"
            icon="fas fa-users" size='lg'>

            @if (!isset($pessoas))
                @foreach ($pessoas as $p)
                    @if ($p['name'] == $g['name'])
                        @php
                            // Retorna o cargo da pessoa baseada no role do Laratrust

                            $idcargo = DB::table('role_user')
                                ->select('role_id')

                                ->where('user_id', $p['id'])
                                ->get()
                                ->toArray();

                            $idcargo = json_decode(json_encode($idcargo), true);

                            $cargo = DB::table('roles')
                                ->select('display_name as cargo')
                                ->where('id', $idcargo[0]['role_id'])
                                ->get()
                                ->toArray();
                            $cargo = json_decode(json_encode($cargo[0]), true);

                        @endphp
                        <x-adminlte-card title="{{ $cargo['cargo'] }}" theme="teal">

                            <b>Nome: </b>{{ $p['nomeusuario'] }}<br>
                            <b>Matrícula: </b> {{ $p['matricula'] }}<br>

                        </x-adminlte-card>
                    @endif
                @endforeach
            @else
                <b>Não há gremistas cadastrados para esta gestão.</b>
            @endif
            <x-slot name="footerSlot">
                @permission('gestoes-delete')
                    <a class="btn bg-warning mr-auto" href="{{ route('gestao.editar', $g['id']) }}" label="Encerrar gestão"
                        theme="warning"><i class="fas fa-users-slash"></i> Encerrar Gestão
                    </a>
                @endpermission
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
