@extends('adminlte::page')
@section('title', 'Novo Empréstimo')

@section('content_header')
    <h1>Novo Empréstimo</h1>
@stop

@section('content')
    @php

    @endphp
    <div class="card">
        <div class="card-body" style="margin-left:auto;margin-right:auto;width:30%">


            <form action="{{ route('patrimonio.storeEmprestimo') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')


                <x-adminlte-select name="patrimonio_id" label="Objeto">
                    <x-slot name="prependSlot">
                        <div class="input-group-text ">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>

                    @if ($e->isNotEmpty())
                        @foreach ($e as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    @else
                        <option>Não há patrimônio a ser emprestado</option>
                    @endif

                </x-adminlte-select>

                <x-adminlte-input required name="name" label="Nome de quem pediu emprestado"
                    placeholder="José da Silva Oliveira" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input required name="matricula" label="Matrícula de quem pediu emprestado"
                    placeholder="20171024010038" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input min="0" disabled value="{{Auth::user()->name}}" required name="gremistaemprestou" label="Gremista que emprestou"
                    placeholder="Felipe Garcia" label-class="text-black">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-badge text-black"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>



                <x-adminlte-button label="Emprestar objeto" type="submit" theme="success" />

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
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Read flag from the controller.
        let shouldFire = @json($fireAlert);

        if (shouldFire) {
            Swal.fire('Opa!', 'Você não está cadastrado em nenhuma entidade e/ou em uma gestão. Por favor, contate a administração', 'danger');
        }

    });
</script>
@stop
