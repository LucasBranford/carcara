@extends('adminlte::page')

@section('title', 'Configurações de Gestão')

@section('content_header')
    <h1>Cadastrar nova gestão</h1>
@stop

@section('content')

    <form action="{{ route('gestao.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        <x-adminlte-input name="name" label="Nome da Gestão" placeholder="Mandacaru">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="far fa-address-card"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-select name="entidade_id" label="Entidade da Gestão">
            <x-slot name="prependSlot">
                <div class="input-group-text  ">
                    <i class="fas fa-car-side"></i>
                </div>
            </x-slot>
            @foreach ($data as $d)
                <option value="{{ $d['id'] }}">{{ $d['name'] }}</option>
            @endforeach
        </x-adminlte-select>
        @php
            $config = ['format' => 'YYYY-MM-DD'];
        @endphp
        <x-adminlte-input-date name="inicio" label="Data de início da Gestão" value=" " placeholder="2000-08-05"
            :config="$config">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-input-date>

        <x-adminlte-select name="provisoria" label="É gestão provisória?">
            <x-slot name="prependSlot">
                <div class="input-group-text  ">
                    <i class="fas fa-car-side"></i>
                </div>
            </x-slot>

            <option value="0">Não</option>
            <option value="1">Sim</option>

        </x-adminlte-select>

        <x-adminlte-input-file name="atadeposse" label="Ata de Posse" placeholder="Escolha um arquivo">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>

        <x-adminlte-button class="btn" type="submit" label="Finalizar Cadastro" theme="success"
            icon="fas fa-lg fa-save" />

    </form>

    <!--fim da classe cardbody-->
    </div>
    </div>



@stop

@section('css')
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            2
            bsCustomFileInput.init()
            3
        })
    </script>


@stop
