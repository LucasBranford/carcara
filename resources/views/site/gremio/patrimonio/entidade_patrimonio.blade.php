@extends('adminlte::page')

@section('title', 'Patrimônio')

@section('content_header')
    <h1>Patrimônio - {{ent(Auth::user()->entidade_id)}} </h1>
@stop

@section('content')
    @php
        //   dd($patrimonio);

        $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Identificação', 'Observações',
        'Modo de Obtenção', 'Custo em R$', 'Emprestável', 'Gremista que cadastrou',
         ['label' => 'Ações', 'no-export' => true, 'orderable' => false]];

        $config = [
            'data' => [],
            'order' => [[1, 'asc']],
            'columns' => [['visible' => false], ['orderable' => true]],
        ];
        foreach ($patrimonio as $c) {
            //Verifica se é Adm para exibir o botão editar
            $btnEditar =
                '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Editar patrimônio" type="submit"
                                                            data-toggle="modal" data-target="#modal-editar-' .
                $c['id'] .
                '"class="bg-danger"  >
                                                <i class="fas fa-edit"></i>                                       </a>';

            $c[] = '<nobr>' . $btnEditar . '</nobr>';
            $config['data'][] = $c;
        }

    @endphp

    @foreach ($patrimonio as $u)
          {{-- Modal para editar patrimonio --}}
        <x-adminlte-modal id="modal-editar-{{ $u['id'] }}" title="{{ $u['name'] }}" theme="primary"
                      icon="fas fa-user-plus" size='lg'>

            <form action="{{ route('patrimonio.update', $u['id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <x-adminlte-input name="name" label="Nome" value="{{ $u['name'] }}" placeholder="Bola quadrada"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-address-card text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input name="identificacao" value="{{ $u['identificacao'] }}"
                    label="Identificação (código de barras etc.)" placeholder="010016589" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-font text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input name="observacao" label="Observações" value="{{ $u['observacao'] }}"
                    placeholder="Bola vermelha no formato cúbico." label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fab fa-stack-exchange"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="obtencao" label="Meio de obtenção">
                    <x-slot name="prependSlot">
                        <div class="input-group-text ">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>

                    <option
                        @php
if ($u['obtencao'] == 'Comprado') {
                            echo 'selected';
                        } @endphp
                        value="Comprado">Comprado</option>
                    <option
                        @php
if ($u['obtencao'] == 'Doado') {
                            echo 'selected';
                        } @endphp
                        value="Doado">Doado</option>
                    <option
                        @php
if ($u['obtencao'] == 'Fabricado') {
                            echo 'selected';
                        } @endphp
                        value="Fabricado">Fabricado</option>

                </x-adminlte-select>

                <x-adminlte-input type="number" min="0" value="{{ $u['custo'] }}" name="custo"
                    label="Custo em R$ (se não houver, 0)" placeholder="35" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-city text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="emprestavel" label="Emprestável">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                    </x-slot>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </x-adminlte-select>


                <x-slot name="footerSlot">

                    <x-adminlte-button label="Confirmar alterações" type="submit" theme="success" />


            </form>

            <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
            </x-slot>
        </x-adminlte-modal>
    @endforeach



    @foreach ($patrimonio as $u)
        {{-- Modal para editar patrimonio --}}
        <x-adminlte-modal id="modal-editar-{{ $u['id'] }}" title="{{ $u['name'] }}" theme="primary"
            icon="fas fa-user-plus" size='lg'>

            <form action="{{ route('patrimonio.update', $u['id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <x-adminlte-input name="name" label="Nome" value="{{ $u['name'] }}" placeholder="Bola quadrada"
                    label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-address-card text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input name="identificacao" value="{{ $u['identificacao'] }}"
                    label="Identificação (código de barras etc.)" placeholder="010016589" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-font text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input name="observacao" label="Observações" value="{{ $u['observacao'] }}"
                    placeholder="Bola vermelha no formato cúbico." label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fab fa-stack-exchange"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="obtencao" label="Meio de obtenção">
                    <x-slot name="prependSlot">
                        <div class="input-group-text ">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>

                    <option
                        @php
if ($u['obtencao'] == 'Comprado') {
                            echo 'selected';
                        } @endphp
                        value="Comprado">Comprado</option>
                    <option
                        @php
if ($u['obtencao'] == 'Doado') {
                            echo 'selected';
                        } @endphp
                        value="Doado">Doado</option>
                    <option
                        @php
if ($u['obtencao'] == 'Fabricado') {
                            echo 'selected';
                        } @endphp
                        value="Fabricado">Fabricado</option>

                </x-adminlte-select>

                <x-adminlte-input type="number" min="0" value="{{ $u['custo'] }}" name="custo"
                    label="Custo em R$ (se não houver, 0)" placeholder="35" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-city text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="emprestavel" label="Emprestável">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                    </x-slot>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </x-adminlte-select>


                <x-slot name="footerSlot">

                    <x-adminlte-button label="Confirmar alterações" type="submit" theme="success" />


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

    @php

    @endphp
@stop

@section('css')
@stop

@section('js')
    <script></script>
@stop
