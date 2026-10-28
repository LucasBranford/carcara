@extends('adminlte::page')

@section('title', 'Configurações da Entidade')

@section('content_header')
    <h1>Painel da Entidade</h1>
@stop

@section('content')



    <div class="card">
             
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('entidades.update', $ent->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="classe">
                        <x-adminlte-input required name="name" label="Nome da Entidade" value="{{ $ent->name }}"
                            placeholder="Grêmio Estudantil Valdemar dos Pássaros" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input required name="sigla" label="Sigla" value="{{ $ent->sigla }}"
                            placeholder="GEDM/CNAT" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-font text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input required name="email" label="E-mail Oficial" value="{{ $ent->email }}"
                            placeholder="gremio.cang@escolar.ifrn.edu.br" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-at text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input required name="instagram" label="Instagram Oficial"
                            value="{{ $ent->instagram }}" placeholder="www.instagram.com/geja.ifrn"
                            label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fab fa-instagram text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
{{-- ------------------------------------------------------------------------------------------------ --}}
                        <x-adminlte-input data-inputmask="'mask': '(99) 9999-9999'" value="{{ $ent->telefone }}"
                            name="telefone" label="Telefone" placeholder="(84) 3422-2665" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <!-- Depois alterar a unidade de ensino -->
                        <x-adminlte-select-bs name="unidade" label="Unidade de Ensino vinculada"
                            data-title="Selecione uma opção" data-live-search data-live-search-placeholder="Selecionar..."
                            data-show-tick>
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-school text-black"></i>
                                </div>
                            </x-slot>
                            @foreach ($data as $d)
                                <option value="{{ $d['id'] }}">{{ $d['name'] }}</option>
                            @endforeach

                        </x-adminlte-select-bs>

                        <x-adminlte-input required name="endereco" label="Endereço da Sede" value="{{ $ent->endereco }}"
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
                        <x-adminlte-input-date name="datafundacao" label="Data de fundação"
                            value="{{ $ent->datafundacao }}" placeholder="08-05-2000" :config="$config">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>

                        <!------------------->

                        <x-adminlte-input-date name="dataofc" label="Data de oficialização" value="{{ $ent->dataofc }}"
                            placeholder="08-05-2000" :config="$config">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>

                        <x-adminlte-input-file name="atafundacao" igroup-size="l" label="Ata de Fundação"
                            placeholder="Escolha um arquivo...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>

                        </x-adminlte-input-file>

                        <x-adminlte-input-file name="logo" label="Logotipo da Entidade" placeholder="Escolha um arquivo">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                        <x-adminlte-input-file name="estatuto" label="Estatuto Atual" placeholder="Escolha um arquivo">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>


                        <x-adminlte-button class="btn bg-success" type="submit" label=" Salvar mudanças"
                            icon="fas fa-lg fa-save" />


                    </form>
                </div>
                <!--fim cardbody-->
          
         



    @stop

    @section('css')
    @stop

    @section('js')





    @stop
