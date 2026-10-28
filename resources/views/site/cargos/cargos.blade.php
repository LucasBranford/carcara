@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cargos e Diretorias </h1>
@stop

@section('content')
    @php
    //Tabela dos cargos que a entidade não tem
    $heads = ['ID', ['label' => 'Cargo', 'width' => 10], 'Diretoria', 'REGIF', 'GEDM', 'GEVP', 'Criado em', 'Alterado em', ['label' => 'Ações', 'no-export' => true, 'width' => 5]];

    $config = [
        'data' => [],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    $car = $cargo->toArray();

    foreach ($car as $c) {
        $btnEdit =
            '<a class="btn btn-xs btn-default text-warning mx-1 shadow" title="Aderir" type="submit"
                                                                                                                                                        data-toggle="modal" data-target="#modal-add-' .
            $c['id'] .
            '"class="bg-danger"  >
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </a>';
        $c[] .= '<nobr>' . $btnEdit . '</nobr>';
        $config['data'][] = $c;
    }

    @endphp
    <!-- modal de editar cargo -->
    @foreach ($car as $c)
        <x-adminlte-modal id="modal-add-{{ $c['id'] }}" title="Editar cargo {{ $c['name'] }}" theme="warning"
            icon="fas fa-id-card-alt" v-centered static-backdrop scrollable>
            <div>
                <form action="{{ route('cargos.add', $c['id']) }}" method="post">
                    @csrf
                    @method('put')

                    <x-adminlte-input name="name" label="Cargo" value="{{ $c['name'] }}" required
                        placeholder="Diretor de Assistência Estudantil" label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-id-card-alt text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <!--
                            <x-adminlte-select name="permissoes" label="Permissões Documentais">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-file-alt text-lightblue"></i>
                                    </div>
                                </x-slot>
                                
                            </x-adminlte-select>
                        -->
                    <x-adminlte-select required name="diretoria" label="Diretoria Vinculada">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-users text-lightblue"></i>
                            </div>
                        </x-slot>
                        @php
                            foreach ($diretoria as $d) {
                                if ($d->name_permi == $c['name_diretoria']) {
                                    echo '<option value="' . $d->id . '" selected>' . $d->id . '. ' . $d->name_diretoria . '</option>';
                                } else {
                                    echo '<option value="' . $d->id . '" >' . $d->id . '. ' . $d->name_diretoria . '</option>';
                                }
                            }
                            
                        @endphp
                    </x-adminlte-select>
                    <input hidden name="cargoalt" value="cargoalt">


            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button class="mr-auto" theme="success" type="submit" label="Salvar Mudanças" />
                <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
                </form>
            </x-slot>

        </x-adminlte-modal>
    @endforeach

    <!--Botão do Modal de Criar Novo Cargo -->
    <x-adminlte-button class="btn" type="reset" label="Criar novo cargo" theme="success" icon="fas fa-plus"
        data-toggle="modal" data-target="#modal-novo" />
    <br>
    <br>
    <!--modal de CRIAR novo cargo-->

    <x-adminlte-modal id="modal-novo" title="Criar cargo" theme="teal" icon="fas fa-id-card-alt" v-centered static-backdrop
        scrollable>
        <div>
            <form action="{{ route('cargos.criar') }}" method="post">
                @csrf
                @method('put')

                <x-adminlte-input name="name" label="Cargo" required placeholder="Diretor de Assistência Estudantil"
                    label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="permissoes" label="Permissões Documentais">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-file-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                    @php
                        
                    @endphp
                </x-adminlte-select>

                <x-adminlte-select required name="diretoria" label="Diretoria Vinculada">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-users text-lightblue"></i>
                        </div>
                    </x-slot>
                    @php
                        foreach ($diretoria as $d) {
                            echo '<option value="' . $d->id . '" >' . $d->id . '. ' . $d->name_diretoria . '</option>';
                        }
                        
                    @endphp
                </x-adminlte-select>


        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" type="submit" label="Salvar Mudanças" />
            <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
            </form>
        </x-slot>

    </x-adminlte-modal>

    <!--Botão do Modal de Criar Novo Cargo -->
    <x-adminlte-button class="btn" type="reset" label="Criar Nova Diretoria" theme="success" icon="fas fa-users"
        data-toggle="modal" data-target="#modal-nova-diretoria" />
    <br>
    <br>

    <!--modal de CRIAR NOVA DIRETORIA-->

    <x-adminlte-modal id="modal-nova-diretoria" title="Criar Diretoria" theme="teal" icon="fas fa-users" v-centered
        static-backdrop scrollable>
        <div>
            <form action="{{ route('diretorias.criar') }}" method="post">
                @csrf
                @method('put')

                <x-adminlte-input name="name" label="Nome da Diretoria" required placeholder="Diretor de Assistência Estudantil"
                    label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-select name="permissoes" label="Permissões Documentais">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-file-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                    @php
                        
                    @endphp
                </x-adminlte-select>

                <x-adminlte-select required name="diretoria" label="Diretoria Vinculada">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-users text-lightblue"></i>
                        </div>
                    </x-slot>
                    @php
                        foreach ($diretoria as $d) {
                            echo '<option value="' . $d->id . '" >' . $d->id . '. ' . $d->name_diretoria . '</option>';
                        }
                        
                    @endphp
                </x-adminlte-select>


        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" type="submit" label="Salvar Mudanças" />
            <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
            </form>
        </x-slot>

    </x-adminlte-modal>
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
        console.log('Hi!');

    </script>
@stop
