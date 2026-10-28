@extends('adminlte::page')
@section('title', 'Encomenda de Fardas')

@section('content_header')
    <h1>Encomendar farda</h1>
@stop

@section('content')
    <form action="{{route('fardas.store')}}" method="post">
        @csrf
        @method("post")
        <x-adminlte-input required readonly value="{{ Auth::user()->name }}" name="name" label="Número de fardas a comprar"
            type="text" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-id-card text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-input data-inputmask="'mask': '(99) 9 9999-9999'" value="" name="telefone" label="Telefone para contato"
            placeholder="(84) 3422-2665" label-class="text-black">
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
            <option value="G Babylook"> G Babylook</option>
            <option value="GG Babylook"> GG Babylook</option>

        </x-adminlte-select>
        <x-adminlte-input required name="quantidade" label="Número de fardas a comprar" type="number" min="0" max="5"
            label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-plus text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-button class="btn" type="submit" label="Confirmar encomenda" theme="success"
            icon="fas fa-lg fa-save" />
    </form>







@stop

@section('css')
@stop

@section('js')

@stop
