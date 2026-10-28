@extends('adminlte::page')
@section('title', 'Novo objeto')

@section('content_header')
    <h1>Início</h1>
@stop

@section('content')
    <x-adminlte-card title="Inserir novo patrimônio" theme="purple" icon="fas fa-lg fa-fan" >

        <form action="{{ route('patrimonio.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')


            <x-adminlte-input required name="name" label="Nome" placeholder="Bola quadrada" label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-address-card text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input required name="identificacao" label="Identificação (código de barras etc.)"
                placeholder="010016589" label-class="text-black">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-font text-black"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input required name="observacao" label="Observações" placeholder="Bola vermelha no formato cúbico."
                label-class="text-black">
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
                <option value="Comprado">Comprado</option>
                <option value="Doado">Doado</option>
                <option value="Fabricado">Fabricado</option>

            </x-adminlte-select>

            <x-adminlte-input type="number" min="0" required name="custo" label="Custo em R$ (se não houver, 0)"
                placeholder="35" label-class="text-black">
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


            <x-adminlte-button label="Inserir novo patrimônio" type="submit" theme="success" />

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </x-adminlte-card>


@stop

@section('css')
@stop

@section('js')

@stop
