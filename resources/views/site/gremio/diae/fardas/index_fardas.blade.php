@extends('adminlte::page')
@section('title', 'Painel de Encomendas')

@section('content_header')
    <h1>Fardas</h1>
@stop

@section('content')

    {{-- <canvas id="line-chart"> </canvas> --}}

    @php
    // dd($encomendas);
    //Tabela dos gestaos que a entidade não tem
    $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Telefone', 'Matrícula', 'Unidade', 'Tamanho', 'Quantidade', 'Ações'];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    foreach ($encomendas as $c) {
        $btnExibir = '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Membros da Gestão" type="submit"
                                                data-toggle="modal" data-target="#modal-gestao-' .
            $c['id'] .
            '"class="bg-danger"  >
                                    <i class="fas fa-shopping-cart"></i>                                       </a>';
        $c[] = '<nobr>' . $btnExibir . '</nobr>';

        $config['data'][] = $c;
    }

    @endphp


    @foreach ($encomendas as $g)
        {{-- --Modal para mostrar os membros da gestão --}}

        <x-adminlte-modal id="modal-gestao-{{ $g['id'] }}" title="Encomenda de {{ $g['comprador'] }}" theme="teal"
            icon="fas fa-users">

            <p> Atenção: o sistema registrará automaticamente a entrada financeira no banco de dados</p>

            <form action="{{ route('vendasfardas.store', [$g['id']]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <x-adminlte-input required readonly value="{{ $g['comprador'] }}" name="participante"
                    label="Número de fardas a comprar" type="text" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input readonly data-inputmask="'mask': '(99) 9999-9999'" value="{{ $g['telefone'] }}"
                    name="telefone" label="Telefone para contato" placeholder="(84) 3422-2665" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-phone text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="tamanho" label="Tamanho da Farda">
                    <x-slot name="prependSlot">
                        <div class="input-group-text  ">
                            <i class="fas fa-tshirt"></i>
                        </div>
                    </x-slot>
                    <option value="PP">PP</option>
                    <option value="P">P</option>
                    <option value="M">M</option>
                    <option value="G">G</option>
                    <option value="PP Babylook">PP Babylook </option>
                    <option value="P Babylook">P Babylook </option>
                    <option value="M Babylook">M Babylook </option>
                    <option value="G Babylook">G Babylook</option>
                    <option value="GG Babylook">GG Babylook</option>

                </x-adminlte-select>
                <x-adminlte-input required name="quantidade" value="{{ $g['quantidade'] }}"
                    label="Número de fardas a comprar" type="number" min="0" max="5"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-plus text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input required name="preco" value="" label="Preço unitário da farda" type="number"
                    min="0" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-money-bill-alt text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input required name="lucro" value="" label="Lucro do grêmio por farda" type="number"
                min="0" label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-money-bill-alt text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
                <x-adminlte-select required name="mododepagamento" label="Modo de pagamento da Transação">
                    <x-slot name="prependSlot">
                        <div class="input-group-text ">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </x-slot>
                    <option value="Dinheiro">Dinheiro</option>
                    <option value="Pix">Pix</option>
                </x-adminlte-select>
                <x-adminlte-input required name="cpfparticipante" label="CPF/CNPJ ou matrícula do Participante"
                    placeholder="123.456.78-90" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input disabled name="gremista" label="Nome do Gremista" value="{{ Auth::user()->name }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text   ">
                            <i class="fas fa-id-badge"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>



                <x-adminlte-input value="" name="cpfgremista"
                    label="CPF ou matrícula do Gremista que realizou a transação" placeholder="123.456.78-90"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input-file name="comprovante" label="Comprovante" placeholder="Escolha um arquivo">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>






                <x-slot name="footerSlot">


                    <x-adminlte-button class="btn" type="submit" label="Confirmar encomenda" theme="success"
                        icon="fas fa-lg fa-save" />
            </form>
            <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
            </x-slot>
        </x-adminlte-modal>
    @endforeach








    <!-- tabela-->
    <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" theme="light" striped hoverable
        with-buttons>

        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>




    {{-- @php
  $e =  json_encode($encomendas)
@endphp --}}


@stop

@section('css')
@stop

@section('js')
    {{-- <script>
    const ctx = document.getElementById('line-chart').getContext('2d');
    const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['PP BL', 'P BL', 'M BL', 'G BL', 'GG BL', 'PP','P','M','G','GG'],
        datasets: [
            {
            label: "Encomendas",
            backgroundColor: "blue",
            data:
        },
        {
            label: "Red",
            backgroundColor: "red",
            data: [4,3,5]
        },
        {
            label: "Green",
            backgroundColor: "green",
            data: [7,2,6]
        }
]
    },
    options: {
        plugins: {
    legend: {
      display: false
    }
  },

        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script> --}}
    <script>
        $(document).ready(function() {
            // Read flag from the controller.
            let shouldFire = @json($fireAlert);

            if (shouldFire) {
                Swal.fire('Success!', 'Entry Successfull', 'success');
            }

        });
    </script>
@stop
