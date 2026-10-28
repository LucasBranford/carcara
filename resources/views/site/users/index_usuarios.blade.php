@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários Cadastrados</h1>
@stop

@section('content')
    @php

        //Tabela dos gestaos que a entidade não tem
        $heads = ['ID', ['label' => 'Nome', 'width' => 10], 'Matrícula', 'E-mail', 'Unidade', 'Equipe', 'Criado em', ['label' => 'Ações', 'no-export' => true, 'width' => 5]];

        $config = [
            'data' => [],
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];

        foreach ($user as $c) {
            $btnExibir =
                '<a class="btn btn-xs btn-default text-success mx-1 shadow" title="Adicionar Permissões" type="submit"
                                            data-toggle="modal" data-target="#modal-gestao-' .
                $c['id'] .
                '"class="bg-danger"  >
                                <i class="fas fa-user-plus"></i>                                       </a>';
            $c[] = '<nobr>' . $btnExibir . '</nobr>';
            $config['data'][] = $c;
        }

    @endphp
    @permission('permissoes-update')

        @foreach ($user as $u)
            {{-- --Modal para mostrar os membros da gestão --}}

            <x-adminlte-modal id="modal-gestao-{{ $u['id'] }}" title="{{ $u['name'] }}" theme="primary"
                icon="fas fa-user-plus" size='lg'>

                <form action="{{ route('usuarios.update', $u['id']) }}" method="post">
                    @csrf
                    @method('post')
                    @php
                        // Retorna o cargo da pessoa baseada no role do Laratrust
                        $idcargo = DB::table('role_user')
                            ->select('role_id')

                            ->where('user_id', $u['id'])
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

                        <b>Nome: </b>{{ $u['name'] }}<br>
                        <b>Matrícula: </b> {{ $u['matricula'] }}<br>
                        <b>Cargo: </b>{{ $cargo['cargo'] }}

                        {{-- Seleciona a equipe (diretoria) para colocar o usuário --}}
                        <x-adminlte-select label="Diretoria" name="team">
                            <option value=""> Nenhum selecionado </option>
                            @foreach ($teams as $t)
                                <option value="{{ $t->id }}">{{ $t->display_name }} </option>
                            @endforeach
                        </x-adminlte-select>

                        {{-- Seleciona o cargo para colocar o usuário --}}
                        <x-adminlte-select label="Cargo" name="role">
                            <option value=""> Nenhum selecionado </option>

                            @foreach ($roles as $r)
                                <option value="{{ $r->id }}">{{ $r->display_name }} </option>
                            @endforeach
                        </x-adminlte-select>

                        {{-- Seleciona a gestão de destino --}}
                        <x-adminlte-select label="Gestão" name="gestao">
                            <option value=""> Nenhum selecionado </option>

                            @foreach ($gestoes as $g)
                                <option value="{{ $g->id }}">{{ $g->name }} </option>
                            @endforeach
                        </x-adminlte-select>

                        {{-- Seleciona a Entidade de destino --}}
                        <x-adminlte-select label="Entidade" name="entidade">
                            <option value=""> Nenhum selecionado </option>

                            @foreach ($entidades as $g)
                                <option value="{{ $g->id }}">{{ $g->name }} </option>
                            @endforeach
                        </x-adminlte-select>

                        {{-- Seleciona a Unidade de destino --}}
                        <x-adminlte-select label="Unidade" name="unidade">
                            <option value=""> Nenhum selecionado </option>

                            @foreach ($unidades as $g)
                                <option value="{{ $g->id }}">{{ $g->name }} </option>
                            @endforeach
                        </x-adminlte-select>


                    </x-adminlte-card>






                    <x-slot name="footerSlot">

                        <x-adminlte-button label="Alterar atributos" type="submit" theme="success" />


                </form>

                <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-modal>
        @endforeach
    @endpermission

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
