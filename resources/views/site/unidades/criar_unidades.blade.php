@extends('adminlte::page')
 @section('title', 'Unidades')

@section('content_header')
    <h1>Início</h1>
@stop

@section('content')
     
<form action="{{ route('unidades.store')}}" method="post">
    @csrf
    @method('post')


    <x-adminlte-input required name="name" label="Nome"   placeholder="Câmpus Mossoró"
        label-class="text-black">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-address-card text-black"></i>
            </div>
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-input required name="sigla" label="Sigla (de acordo com o SUAP)"  placeholder="CNAT"
        label-class="text-black">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-font text-black"></i>
            </div>
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-input required name="cidade" label="Cidade"  placeholder="Mossoró, RN"
        label-class="text-black">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-city text-black"></i>
            </div>
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-input required name="endereco" label="Endereço" 
        placeholder="R. Raimundo Firmino de Oliveira, 400 - Conjunto Ulrick Graff, Mossoró - RN, 59628-330" label-class="text-black">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-location-arrow text-black"></i>
            </div>
        </x-slot>
    </x-adminlte-input>





    

        <x-adminlte-button label="Confirmar alterações" type="submit" theme="success" />


</form>
 
@stop

@section('css')
 @stop

@section('js')

@stop

