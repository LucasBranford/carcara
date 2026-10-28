@extends('adminlte::page')

@section('title', 'Lista de Gestões')

@section('content_header')
    <h1>Entidade</h1>
@stop

@section('content')

    <div class="accordion" id="accordion-gestoes">
         @foreach ($todas as $t)


            <div class="card">
                <div class="card-header" id="heading{{ $t->id }}">

                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $t->id }}" aria-expanded="true"
                            aria-controls="collapse{{ $t->id }}">
                            {{ $t->id . '. ' . $t->name }}
                        </button>
                    </h2>
                </div>

                <div id="collapse{{ $t->id }}" class="collapse" aria-labelledby="heading{{ $t->id }}"
                    data-parent="#accordion-gestoes">
                    <div class="card-body">

                        <x-adminlte-input disabled required name="name" label="Nome da Gestão" value="{{ $t->name }}"
                            placeholder="Grêmio Estudantil Valdemar dos Pássaros" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
{{-- necessário ajeitar para mostrar o nome da entidade da gestão --}}
                        <x-adminlte-input disabled required name="entidade" label="Entidade" value="{{ $t->entidade }}"
                            placeholder="GEDM/CNAT" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-font text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        


                        @php
                            $config = ['format' => 'YYYY-MM-DD'];
                        @endphp
                        <x-adminlte-input-date disabled name="inicio" label="Data de fundação"
                            value="{{ $t->inicio }}" placeholder="08-05-2000" :config="$config">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>
                        <!------------------->

                        <x-adminlte-input-date disabled name="termino" label="Data de oficialização"
                            value="{{ $t->termino}}" placeholder="08-05-2000" :config="$config">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>


                       
                            <a class="btn bg-success" href="{{ asset('storage/' . $t->atadeposse) }}"><i
                                    class="fas fa-lg fa-scroll"></i> Ata de
                                Fundação</a>
                            @permission('gestoes-update')

                                {{-- <a class="btn bg-warning" href="{{ route('gestao.editar', $t->id) }}"><i
                                        class="fas fa-lg fa-cogs"></i> Editar Entidade</a> --}}
                                @endpermission

                                </form>
                            </div>
                            <!--fim da classe cardbody-->
                        </div>
                    </div>

                @endforeach

            </div>
            <!--fim do acordeão--->
        @stop

        @section('css')
         @stop

        @section('js')





        @stop
