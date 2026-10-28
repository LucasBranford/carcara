@extends('adminlte::page')
@section('title', 'Adicionar entrada')

@section('content_header')
    <h1>Nova movimentação</h1>
@stop

@section('content')
    <form action="{{route('financas.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')

        <x-adminlte-select required name="mododepagamento" label="Modo de pagamento da Transação">
            <x-slot name="prependSlot">
                <div class="input-group-text ">
                    <i class="fas fa-credit-card"></i>
                </div>
            </x-slot>
            <option value="Dinheiro">Dinheiro</option>
            <option value="Pix">Pix</option>
        </x-adminlte-select>

        <x-adminlte-select required name="tipo" label="Tipo da Transação">
            <x-slot name="prependSlot">
                <div class="input-group-text ">
                    <i class="fas fa-credit-card"></i>
                </div>
            </x-slot>
            <option value="Entrada">Entrada</option>
            <option value="Saída">Saída</option>
        </x-adminlte-select>


        <x-adminlte-input required name="valor" label="Valor da transação"   placeholder="35,75" type="number"
            label-class="text-success">
            <x-slot name="prependSlot">
                <div class="input-group-text text-success ">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input name="participante" label="Nome do Participante"
         >
            <x-slot name="prependSlot">
                <div class="input-group-text   ">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input required  data-inputmask="'mask': '999.999.999-99'"  name="cpfparticipante" label="CPF/CNPJ ou matrícula do Participante"
            placeholder="123.456.78-90" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-id-card text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

       <x-adminlte-input disabled  name="gremista" label="Nome do Gremista" value="{{Auth::user()->name}}">
          <x-slot name="prependSlot">
              <div class="input-group-text   ">
                  <i class="fas fa-id-badge"></i>
              </div>
          </x-slot>
      </x-adminlte-input>
      <x-adminlte-input  name="identificacao" label="Identificação" value="{{Str::random(10)}}">
        <x-slot name="prependSlot">
            <div class="input-group-text   ">
                <i class="fab fa-amilia"></i>
            </div>
        </x-slot>
    </x-adminlte-input>


     <x-adminlte-input data-inputmask="'mask': '999.999.999-99'" value=""  name="cpfgremista" label="CPF do Gremista que realizou a transação"
            placeholder="123.456.78-90" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-id-card text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input-file name="comprovante" label="Comprovante" placeholder="Escolha um arquivo">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>

        <x-adminlte-button   type="submit" label="Adicionar movimentação" theme="success" icon="fas fa-lg fa-save"/>

    </form>







@stop

@section('css')
@stop

@section('js')

@stop
