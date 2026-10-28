@extends('adminlte::page')
@section('title', 'Votações')

@section('content_header')
    <h1>Todas as Votações</h1>
@stop

@section('content')
    @php
    use Carbon\Carbon;
    //Tabela dos gestaos que a entidade não tem
    $heads = [['label' => 'ID', 'no-export' => true, 'width' => 5], ['label' => 'Nome', 'width' => 30], 'Matrícula', 'Unidade', 'Eleição','ID da votação',
     ['label' => 'Ações', 'no-export' => true, 'width' => 5]];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];

     foreach ($votantes as $c) {
        
        

        $btnExibir =
            '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Anular voto" type="submit"
                                    data-toggle="modal" data-target="#modal-anular-' .
            $c['id'] .
            '"class="bg-danger"  >
                        <i class="fas fa-times"></i>                                       </a>';
        // $c[] = '<nobr>' . $btnExibir .  '</nobr>';
        //     '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Anular voto" type="submit"
        //                               href="' .route('votacao.delete',$c['id']).
            
        //     '" class="bg-danger"  >
        //                 <i class="fas fa-trash"></i>                                       </a>';
        $c[] = '<nobr>' . $btnExibir .  '</nobr>';
      $config['data'][] = $c;
        
    }

    @endphp
    @foreach ($votantes as $u)
    {{-- Modal para anular votos --}}
    <x-adminlte-modal id="modal-anular-{{ $u['id'] }}" title="{{ $u['name'] }}" theme="primary"
        icon="fas fa-user-plus" size='lg'>

        <form action="{{ route('votacao.delete', $u['id']) }}" method="post">
            @csrf
            @method('PUT')


            <x-adminlte-input  readonly name="votante" label="Nome" value="{{$u['name']}} "
                label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-address-card text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input readonly name="" label="Gremista" value="{{ Auth::user()->name }}"  
                label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-font text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input   name="justificativa" label="Justificativa" value="" placeholder="O estudante não faz parte do público-alvo da votação"
                label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-align-justify text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
           <input hidden readonly value="{{$u['votacao_id']}}" name="votacao_id">

            <x-slot name="footerSlot">

                <x-adminlte-button label="Confirmar anulação" type="submit" theme="success" />


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

@push('js')
 
@endpush

@stop
