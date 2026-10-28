@extends('adminlte::page')

@section('title', 'Patrimônio')

@section('content_header')
    <h1>Empréstimo</h1>
@stop

@section('content')
    @php

    $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Objeto', 'Data de Devolução', 'Matrícula de quem pediu emprestado', 'Gremista que emprestou', 'Gremista que devolveu', 'Status', 'Emprestado em', ['label' => 'Ações', 'no-export' => true, 'orderable' => false]];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [['visible' => false], ['orderable' => true]],
    ];
    foreach ($e as $c) {
        //Verifica se é Adm para exibir o botão editar
        if (Auth::user()->hasRole('gremista')) {
            if ($c['status'] != 'Encerrado') {
                $btnEditar = '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Editar patrimônio" type="submit"
                                                                            data-toggle="modal" data-target="#modal-emprestimo-' .
                $c['id'] .
                '"class="bg-danger"  >
                                                                <i class="fas fa-edit"></i>                                       </a>';

                $c[] = '<nobr>' . $btnEditar . '</nobr>';
            } else{
                $btnEditar = '<a disabled class="btn btn-xs btn-default text-secondary mx-1 shadow" title="Editar patrimônio" type="submit"
                                                                            data-toggle="modal" data-target="#modal-emprestimo-' .
                
                '"class="bg-danger"  >
                                                                <i class="fas fa-edit"></i>                                       </a>';

                $c[] = '<nobr>' . $btnEditar . '</nobr>';
            }
        }

        $config['data'][] = $c;
    }

    @endphp
    @foreach ($e as $c)
        {{-- Custom --}}
        <x-adminlte-modal id="modal-emprestimo-{{ $c['id'] }}" title="Encerrar empréstimo" theme="teal"
            icon="fas fa-bell" v-centered static-backdrop scrollable>
            <form action="{{ route('patrimonio.encerrarEmprestimo', [$c['id']]) }}" method="post">
                @csrf
                @method('PUT')

                <input hidden readonly value="{{ $c['id'] }}">
                <x-adminlte-input required name="name" disabled value="{{ Auth::user()->name }}"
                    label="Gremista a quem foi devolvido" placeholder="José da Silva Oliveira" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>


                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Encerrar empréstimo" />
            </form>


            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" />
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
<script>
    $(document).ready(function() {
        // Read flag from the controller.
        let shouldFire = @json($fireAlert);

        if (shouldFire) {
            Swal.fire('Opa!', 'Você não está cadastrado em nenhuma entidade e/ou em uma gestão. Por favor, contate a administração', 'danger');
        }

    });
</script>
@stop
