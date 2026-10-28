@extends('adminlte::page')

@section('title', 'Configurações de Gestão')

@section('content_header')
    <h1>Editar Gestão </h1>
@stop

@section('content')

    <form action="{{ route('gestao.update', $data['id']) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-adminlte-input required name="name" label="Nome da Entidade" value="{{ $data['name'] }}"
            placeholder="Grêmio Estudantil Valdemar dos Pássaros" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        @php
            $config = ['format' => 'YYYY-MM-DD'];
        @endphp
        <x-adminlte-input-date name="inicio" label="Data de Início" value="{{ $data['inicio'] }}"
            placeholder="08-05-2000" :config="$config">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-input-date>

        <x-adminlte-input-date name="termino" label="Data de Término da Gestão" value=""
            placeholder="08-05-2000" :config="$config">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-input-date>
        <x-adminlte-button class="btn bg-danger mb-1" type="submit" label=" Finalizar gestão"
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
