@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastrar novo membro de gestão</h1>
@stop

@section('content')

    <form action="{{ route('permissoes.editar') }}">
        @csrf
        @method('get')
        {{-- Seleciona o usuário a ter permissão de equipe e gestão alteradas --}}
        <x-adminlte-select label="Usuário" name="user">
            @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }} </option>
            @endforeach
        </x-adminlte-select>
        {{-- Seleciona a equipe (diretoria) para colocar o usuário --}}
        <x-adminlte-select label="Diretoria" name="team">
            @foreach ($teams as $t)
                <option value="{{ $t->id }}">{{ $t->display_name }} </option>
            @endforeach
        </x-adminlte-select>
        {{-- Seleciona o cargo para colocar o usuário --}}
        <x-adminlte-select label="Cargo" name="role">
            @foreach ($roles as $r)
                <option value="{{ $r->id }}">{{ $r->display_name }} </option>
            @endforeach
        </x-adminlte-select>

        {{-- Seleciona a gestão de destino --}}
        <x-adminlte-select label="Gestão" name="gestao">
            @foreach ($gestoes as $g)
                <option value="{{ $g->id }}">{{ $g->name }} </option>
            @endforeach
        </x-adminlte-select>

        {{-- Seleciona a Entidade de destino --}}
        <x-adminlte-select label="Entidade" name="entidade">
            @foreach ($entidades as $g)
                <option value="{{ $g->id }}">{{ $g->name }} </option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-button label="Enviar" type='submit' theme="success" icon="fas fa-thumbs-up" />

    </form>

@stop

@section('css')
@stop

@section('js')

@stop
