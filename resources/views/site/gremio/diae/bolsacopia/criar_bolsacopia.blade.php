@extends('adminlte::page')
@section('title', 'Bolsa Cópia')

@section('content_header')
    <h1>Adicionar nova bolsa</h1>
@stop

@section('content')
    <form action="{{ route('bolsacopia.store') }}" method="post">
        @csrf
        @method('post')
        <x-adminlte-input required name="name" label="Nome do estudante" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input required name="matricula" label="Matrícula" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-id-card text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-input required name="laudas" label="Laudas" type="number" min="0" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-print text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-button class="btn" type="submit" label="Finalizar Cadastro" theme="success"
        icon="fas fa-lg fa-save" />
</form>

        {{-- Modal para mudar o limite de cópias --}}
        {{-- Themed --}}
        <x-adminlte-modal id="modal-limite" title="Alterar máximo de cópias" theme="danger" icon="fas fa-print"
           >
           {{-- <form action="{{ route('bclimite.update') }}" method="post"> --}}
            @csrf
            @method('post')

           </form>
                </x-adminlte-modal>
        {{-- Example button to open modal --}}
        <x-adminlte-button label="Alterar limite máximo de cópias" data-toggle="modal" data-target="#modal-limite" class="bg-purple" />



    <a class="btn bg-danger" href="{{route('bc.reiniciarbimestre')}}" label="Finalizar Cadastro">Reiniciar Bimestre</a>




@stop

@section('css')
@stop

@section('js')

@stop
