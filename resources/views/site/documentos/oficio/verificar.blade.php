@extends('adminlte::page')
@section('title', 'Verificador')

@section('content_header')
    <h1>Verificar Ofício</h1>
@stop

@section('content')
    <form action="{{ route('oficio.verificando') }}" method = "post">
        @csrf
        @method("get")
        <x-adminlte-input required name="codigo_verificacao" label="Código de Verificação" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-font text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-input required name="codigo_autenticacao" label="Código de Autenticação" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-font text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-button class="btn bg-success mb-1" type="submit" label=" Verificar ofício" icon="fas fa-lg fa-eye" />
    </form>







@stop

@section('css')
@stop

@section('js')

@stop
