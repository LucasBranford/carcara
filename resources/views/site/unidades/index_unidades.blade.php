@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Unidades Administativas (<i>Campi</i> e Reitoria)</h1>
@stop

@section('content')
    @php
    //Verifica se o usuário é Administrador para exibir a coluna Ações
if (Auth::user()->hasRole(['superadministrador','administrador'])){    //Tabela dos gestaos que a entidade não tem
    $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Sigla', 'Cidade', 'Endereço', ['label' => 'Ações', 'no-export' => true, 'width' => 5]];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];

    foreach ($unidades as $c) {
        $btnExcluir = "";
        //verifica se o usuário é superadministrador ou administrador
        if (Auth::user()->hasRole(['superadministrador','administrador'])){
            $btnExcluir =  '<a class="btn btn-xs btn-default text-danger mx-1 shadow" title="Adicionar Permissões" type="submit"
                                                      href="unidades/excluir/      ' .
            $c['id'] .
            '"class="bg-danger"  >
                                                <i class="fas fa-trash"></i>                                       </a>';;

        }
        $btnExibir =
            '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Adicionar Permissões" type="submit"
                                                            data-toggle="modal" data-target="#modal-gestao-' .
            $c['id'] .
            '"class="bg-danger"  >
                                                <i class="fas fa-edit"></i>                                       </a>';
                                                $btn =

        $c[] = '<nobr>' . $btnExibir . $btnExcluir . '</nobr>';
        $config['data'][] = $c;
    }
} else{

    $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Sigla', 'Cidade', 'Endereço' ];

$config = [
    'data' => [],
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];

foreach ($unidades as $c) {
     
    $config['data'][] = $c;
}}

    @endphp

    @foreach ($unidades as $u)
        {{-- Modal para editar unidades --}}
        <x-adminlte-modal id="modal-gestao-{{ $u['id'] }}" title="{{ $u['name'] }}" theme="primary"
            icon="fas fa-user-plus" size='lg'>

            <form action="{{ route('unidades.update', $u['id']) }}" method="post">
                @csrf
                @method('post')


                <x-adminlte-input   name="name" label="Nome" value="{{ $u['name'] }}"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-address-card text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input   name="sigla" label="Sigla" value="{{ $u['sigla'] }}" placeholder="CNAT"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-font text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input   name="cidade" label="Cidade" value="{{ $u['cidade'] }}" placeholder="Mossoró"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-city text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input   name="endereco" label="Endereço" value="{{ $u['endereco'] }}"
                    placeholder="R. Raimundo Firmino de Oliveira, 400 - Conjunto Ulrick Graff, Mossoró - RN, 59628-330" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-location-arrow text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>





                <x-slot name="footerSlot">

                    <x-adminlte-button label="Confirmar alterações" type="submit" theme="success" />


            </form>

            <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
            </x-slot>
        </x-adminlte-modal>
    @endforeach



    <!-- tabela-->
    <x-adminlte-datatable id="table2" with-buttons :heads="$heads" head-theme="dark" theme="light" striped hoverable>

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
