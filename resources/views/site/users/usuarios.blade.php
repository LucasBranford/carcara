@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Alterar Usuários</h1>
@stop

@section('content')


    <form action="{{route('usuarios.storeEditAll') }}" method="post">
        @csrf
        @method('post')
        @php
        $config = [
            'placeholder' => 'Select multiple options...',
            'allowClear' => false,
        ];
    @endphp
    <x-adminlte-select2 id="usuarios" name="usuarios[]" label="Usuários por matrícula"
         :config="$config" multiple>
        @foreach ($u as $i)
            <option value="{{$i['id']}}">{{$i['matricula']}}</option>
        @endforeach
    </x-adminlte-select2>

        {{-- Seleciona a diretoria/equipe (team) para colocar o usuário --}}

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


        <button class="btn bg-success" type="submit">Confirmar</button>


    </form>

@stop


@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#usuarios').select2({
                placeholder: 'Selecione os itens',
                width: '100%'
            });
        });
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/pt-BR.js"></script>

@stop
