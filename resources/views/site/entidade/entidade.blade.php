@extends('adminlte::page')

@section('title', 'Configurações da Entidade')

@section('content_header')
    <h1>Entidade</h1>
@stop

@section('content')

    <div class="accordion" id="accordion-entidades">

        @foreach ($todas as $t)
            <div class="card">
                <div class="card-header" id="heading{{ $t->id }}">

                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $t->id }}" aria-expanded="true"
                            aria-controls="collapse{{ $t->id }}">
                            <img src="{{ asset('storage/' . $t->logo) }}" height="50px"> {{ $t->id . '. ' . $t->name }}
                        </button>
                    </h2>
                </div>

                <div id="collapse{{ $t->id }}" class="collapse" aria-labelledby="heading{{ $t->id }}"
                    data-parent="#accordion-entidades">
                    <div class="card-body">

                        <x-adminlte-input disabled required name="name" label="Entidade" value="{{ $t->name }}"
                            placeholder="Grêmio Estudantil Valdemar dos Pássaros" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input disabled required name="sigla" label="Sigla" value="{{ $t->sigla }}"
                            placeholder="GEDM/CNAT" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-font text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input disabled name="email" label="E-mail Oficial" value="{{ $t->email }}"
                            placeholder="gremio.cang@escolar.ifrn.edu.br" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-at text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input disabled required name="instagram" label="Instagram Oficial"
                            value="{{ $t->instagram }}" placeholder="www.instagram.com/geja.ifrn"
                            label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fab fa-instagram text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input disabled data-inputmask="'mask': '(99) 9999-9999'" value="{{ $t->telefone }}"
                            name="telefone" label="Telefone" placeholder="(84) 3422-2665" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <!-- Depois alterar a unidade de ensino -->
                        <x-adminlte-input disabled name="unidade" label="Unidade de Ensino vinculada"
                            value="{{ $t->unidade }}" placeholder="IFRN - Câmpus Mossoró" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-school text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input disabled name="endereco" label="Endereço da Sede" value="{{ $t->endereco }}"
                            placeholder="Rua Manoel Lopes Filho, 773, Currais Novos - RN, 59380-000, Sala 110"
                            label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-map-marked-alt text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>


                        @php
                            $config = ['format' => 'YYYY-MM-DD'];
                        @endphp
                        <x-adminlte-input-date disabled name="datafundacao" label="Data de fundação"
                            value="{{ $t->datafundacao }}" placeholder="08-05-2000" :config="$config">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>
                        <!------------------->

                        <x-adminlte-input-date disabled name="dataofc" label="Data de oficialização"
                            value="{{ $t->dataofc }}" placeholder="08-05-2000" :config="$config">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>



                        <a class="btn bg-success" href="{{ asset('storage/' . $t->atafundacao) }}"><i
                                class="fas fa-lg fa-scroll"></i> Ata de
                            Fundação</a>
                            <a class="btn bg-danger" href="{{ asset('storage/' . $t->estatuto) }}"><i
                                class="fas fa-lg fa-book"></i> Estatuto Atual</a>
                        @permission('entidades-update')
                            <a class="btn bg-warning" href="{{ route('entidades.editar', $t->id) }}"><i
                                    class="fas fa-lg fa-cogs"></i> Editar Entidade</a>
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
