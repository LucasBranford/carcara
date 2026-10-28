@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Documentos</h1>
@stop

@section('content')
@php
  //Tabela de todos os documentos do sistema
$heads = ['ID', ['label' => 'Entidade', 'width' => 20], ['label' => 'Título', 'width' => 20], ['label' => 'Autoria', 'width' => 20], 'Criado em', 'Alterado em', 'Assinado em', 'Ações'];

$config = [
    'data' => [],
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
//Transforma a variável dos ofícios para Array
$ofc = $ofc->toArray();

//Verifica se há ofícios
// if (isset($ofc)) {
foreach ($ofc as $c) {
    $btnAssinar = '';
    $btnEditar = '';
    if ($c['assinado'] == null) {
        $btnAssinar =
            '<a class="btn btn-xs btn-default text-danger   mx-1 shadow" title="Assinar" type="submit"
                                                href="' .
            route('oficio.assinar', ['id' => $c['id']]) . '"' .
            $c['id'] .
            '"class="bg-danger"  >
                                             <i class="fa fa-lg fa-fw fa-signature"></i>
                                        </a>';
        $btnEditar =
            '<a class="btn btn-xs btn-default text-success   mx-1 shadow" title="Editar" type="submit"
                                                href="' .
            route('oficio.editar', ['id' => $c['id']]) . '"' .
            $c['id'] .
            '"class="bg-danger"  >
                                             <i class="fa fa-lg fa-fw fa-edit"></i>
                                        </a>';
    } else {
        $btnAssinar = '';

        $btnEditar = '';
    }

    $btnImprimir =
        '<a class="btn btn-xs btn-default   text-primary mx-1 shadow" title="Imprimir" type="submit"
                                                href="' .
        route('oficio.imprimir', ['id' => $c['id']]) .
        '"' .
        $c['id'] .
        '"class="bg-danger"  >
                                             <i class="fa fa-lg fa-fw fa-print"></i>
                                        </a>';
    $c[] .= '<nobr>' . $btnImprimir . $btnEditar . $btnAssinar . '</nobr>';

    $config['data'][] = $c;
    // }
}
@endphp

<br>



<div class="accordion" id="accordion">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Ofícios
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <!-- tabela ofícios -->
                <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" theme="light" striped
                    hoverable with-buttons>

                    @foreach ($config['data'] as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{!! $cell !!}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Atas </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                @php
                    //Tabela de todos os documentos do sistema
                    $heads = ['ID', ['label' => 'Entidade', 'width' => 20], ['label' => 'Título', 'width' => 20], ['label' => 'Autoria', 'width' => 20], 'Criado em', 'Alterado em', 'Assinado em', 'Ações'];

                    $config = [
                        'data' => [],
                        'order' => [[1, 'asc']],
                        'columns' => [null, null, null, ['orderable' => false]],
                    ];
                    //Transforma a variável dos atas para Array
                    $ata = $ata->toArray();

                    //Verifica se há atas
                    // if (isset($ofc)) {
                    foreach ($ata as $c) {
                        $btnAssinar = '';
                        $btnEditar = '';
                        if ($c['assinado'] == null) {
                            $btnAssinar =
                                '<a class="btn btn-xs btn-default text-danger   mx-1 shadow" title="Assinar" type="submit"
                                                                href="' .
                            route('ata.assinar', ['id' => $c['id']]) . '"' .
                                $c['id'] .
                                '"class="bg-danger"  >
                                                                                                                         <i class="fa fa-lg fa-fw fa-signature"></i>
                                                                                                                    </a>';
        $btnEditar =
            '<a class="btn btn-xs btn-default text-success   mx-1 shadow" title="Editar" type="submit"
                                                                                                                            href="' .
                            route('ata.editar', ['id' => $c['id']]) . '"' .
            $c['id'] .
            '"class="bg-danger"  >
                                                             <i class="fa fa-lg fa-fw fa-edit"></i>
                                                        </a>';
                        } else {
                            $btnAssinar = '';

                            $btnEditar = '';
                        }

                        $btnImprimir =
                            '<a class="btn btn-xs btn-default   text-primary mx-1 shadow" title="Imprimir" type="submit"
                                                                href="' .
                        route('ata.imprimir', ['id' => $c['id']]) .
                        '"' .
                            $c['id'] .
                            '"class="bg-danger"  >
                                                                                                                         <i class="fa fa-lg fa-fw fa-print"></i>
                                                                                                                    </a>';
    $c[] .= '<nobr>' . $btnImprimir . $btnEditar . $btnAssinar . '</nobr>';

    $config['data'][] = $c;
                    }
                @endphp
                <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" theme="light" striped
                    hoverable with-buttons>

                    @foreach ($config['data'] as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{!! $cell !!}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Portarias                    </button>
            </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                @php
                    //Tabela de todos os documentos do sistema
                    $heads = ['ID', ['label' => 'Entidade', 'width' => 20], ['label' => 'Título', 'width' => 20], ['label' => 'Autoria', 'width' => 20], 'Criado em', 'Alterado em', 'Assinado em', 'Ações'];

                    $config = [
                        'data' => [],
                        'order' => [[1, 'asc']],
                        'columns' => [null, null, null, ['orderable' => false]],
                    ];
                    //Transforma a variável dos atas para Array
                    $port = $port->toArray();

                     foreach ($port as $c) {
                        $btnAssinar = '';
                        $btnEditar = '';
                        if ($c['assinado'] == null) {
                            $btnAssinar =
                                '<a class="btn btn-xs btn-default text-danger   mx-1 shadow" title="Assinar" type="submit"
                                                            href="' .
                        route('portaria.assinar', ['id' => $c['id']]) . '"' .
                                $c['id'] .
                                '"class="bg-danger"  >
                                                                                                                     <i class="fa fa-lg fa-fw fa-signature"></i>
                                                                                                                </a>';
        $btnEditar =
            '<a class="btn btn-xs btn-default text-success   mx-1 shadow" title="Editar" type="submit"
                                                                                                                        href="' .
                        route('portaria.editar', ['id' => $c['id']]) . '"' .
            $c['id'] .
            '"class="bg-danger"  >
                                                         <i class="fa fa-lg fa-fw fa-edit"></i>
                                                    </a>';
                        } else {
                            $btnAssinar = '';

                            $btnEditar = '';
                        }

                        $btnImprimir =
                            '<a class="btn btn-xs btn-default   text-primary mx-1 shadow" title="Imprimir" type="submit"
                                                            href="' .
                    route('portaria.imprimir', ['id' => $c['id']]) .
                    '"' .
                            $c['id'] .
                            '"class="bg-danger"  >
                                                                                                                     <i class="fa fa-lg fa-fw fa-print"></i>
                                                                                                                </a>';
    $c[] .= '<nobr>' . $btnImprimir . $btnEditar . $btnAssinar . '</nobr>';

    $config['data'][] = $c;
                    }
                @endphp
                <x-adminlte-datatable id="table3" :heads="$heads" head-theme="dark" theme="light" striped
                    hoverable with-buttons>

                    @foreach ($config['data'] as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{!! $cell !!}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Read flag from the controller.
            let shouldFire = @json($fireAlert);

            if (shouldFire) {
                Swal.fire('Opa!',
                    'Você não está cadastrado em nenhuma entidade e/ou em uma gestão. Por favor, contate a administração.',
                    'warning');
            }

        });
    </script>
@stop
