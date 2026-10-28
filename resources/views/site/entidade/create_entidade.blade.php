@extends('adminlte::page')

@section('title', 'Configurações da Entidade')

@section('content_header')
    <h1>Cadastrar Entidade</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <form action="{{ route('entidades.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        <x-adminlte-input required name="name" label="Entidade" 
            placeholder="Grêmio Estudantil Valdemar dos Pássaros" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input required name="sigla" label="Sigla" value="" placeholder="GEDM" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-font text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-input name="email" label="E-mail Oficial" value="" placeholder="gremio.cang@escolar.ifrn.edu.br"
            label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-at text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input required name="instagram" label="Instagram Oficial" value=""
            placeholder="www.instagram.com/geja.ifrn" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fab fa-instagram text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input data-inputmask="'mask': '(99) 9999-9999'" value="" name="telefone" label="Telefone"
            placeholder="(84) 3422-2665" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-phone text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>




        {{-- With prepend slot, label and data-* config --}}
        <x-adminlte-select-bs name="unidade_id" label="Unidade de Ensino vinculada" label-class="text-lightblue"
            data-title="Selecione uma opção" data-live-search data-live-search-placeholder="Selecionar..." data-show-tick>
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-school text-black"></i>
                </div>
            </x-slot>
            @foreach ($unidade as $u)
                <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>
            @endforeach

        </x-adminlte-select-bs>

        <x-adminlte-input name="endereco" label="Endereço da Sede" value=""
            placeholder="Rua Manoel Lopes Filho, 773, Currais Novos - RN, 59380-000, Sala 110" label-class="text-black">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-map-marked-alt text-black"></i>
                </div>
            </x-slot>
        </x-adminlte-input>


        @php
            $config = ['format' => 'YYYY-MM-DD'];
        @endphp
        <x-adminlte-input-date name="datafundacao" label="Data de fundação" value=" " placeholder="2000-08-05"
            :config="$config">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-input-date>
        <!------------------->

        {{-- <x-adminlte-input-date name="dataofc" label="Data de oficialização" value="" placeholder="08-05-2000"
            :config="$config">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </x-slot>
        </x-adminlte-input-date>

        <x-adminlte-input-file name="atafundacao" label="Ata de Fundação" placeholder="Escolha um arquivo">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file> --}}


        <x-adminlte-input-file name="estatuto" label="Estatuto Atual (Apenas arquivos .pdf)"
            placeholder="Escolha um arquivo">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>

        <x-adminlte-input-file name="atafundacao" label="Ata de Fundação"
            placeholder="Escolha um arquivo">
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



        @permission('entidades-create')
            <x-adminlte-button class="btn" type="submit" label="Finalizar Cadastro" theme="success"
                icon="fas fa-lg fa-save" />
        @endpermission

    </form>
    </div>
    <!--fim da classe cardbody-->
    </div>
    </div>

   

@stop

@section('css')
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            2
            bsCustomFileInput.init()
            3
        })
    </script>


@stop
