@extends('adminlte::page')
@section('title', 'Votações')

@section('content_header')
    <h1>Todas as Votações</h1>
@stop

@section('content')
    @php
    use Carbon\Carbon;
    //Tabela dos gestaos que a entidade não tem
    $heads = [['label' => 'ID', 'no-export' => true, 'width' => 5], ['label' => 'Nome', 'width' => 10],
     'Descrição', 'Responsável', 'Início', 'Término', 'Início da validação','Término da validação','Status', 'Criada em',
      'Modificada em', ['label' => 'Ações', 'no-export' => true, 'width' => 5]];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];

if(!empty($votacoes)){
    foreach ($votacoes as $c) {
        //Verifica se a eleição já começou, se o dia de início é maior ou igual que o dia atual
        if ($c['inicio'] <= Carbon::now()) {
     $config['data'][] = $c;
        }
    }}

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

@push('js')
<script>
    $(document).ready(function()
    {
        // Read flag from the controller.
        let shouldFire = @json($fireAlert);

        if (shouldFire) {
            Swal.fire('Opa!', 'A eleição ainda não começou ou já terminou', 'danger');
        }

    });
</script>
@endpush

@stop
