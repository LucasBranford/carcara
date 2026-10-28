@extends('adminlte::page')
@section('title', 'Votação')

@section('content_header')
    <h1>Nova Votação</h1>
@stop

@section('content')




    <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false"
            aria-controls="collapse1">Criar nova votação</a>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse2"
            aria-expanded="false" aria-controls="collapse2">Adicionar opções a uma votação</button>

    </p>
    <div class="row">
        <div class="col">
            <div class="collapse multi-collapse" id="collapse1">
                <div class="card card-body">
                    <form action="{{ route('votacao.store') }}" method="post">
                        @csrf
                        @method('post')
                        <x-adminlte-input required name="name" label="Nome da Votação" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input required name="descricao" label="Descrição" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input required name="inicio" label="Data e hora de início da votação"
                            type="datetime-local" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-print text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input required name="termino" label="Data e hora de término da votação"
                            type="datetime-local" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-print text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input required name="inicio_validacao" label="Data e hora de início da validação dos votos"
                            type="datetime-local" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-print text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input required name="termino_validacao" label="Data e hora de término da validação dos votos"
                            type="datetime-local" label-class="text-black">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-print text-black"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                       
                        <x-adminlte-button class="btn" type="submit" label="Finalizar Cadastro" theme="success"
                            icon="fas fa-lg fa-save" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="collapse multi-collapse" id="collapse2">
                <div class="card card-body">
                    <form action="{{ route('opcao.store') }}" method="post">
                    @csrf
                    @method('post')
                    <x-adminlte-select name="votacao_id" label="Escolha a votação">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-list"></i>
                            </div>
                        </x-slot>

                        @if (isset($votacoes))
                            @foreach ($votacoes as $v)
                                {

                                <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>

                                }
                            @endforeach

                        @else
                        <option value="">Não há eleições ativas</option>

                        @endif
                    </x-adminlte-select>

                    <x-adminlte-input required name="name" label="Nome da opção" label-class="text-black">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-id-card text-black"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input required name="descricao" label="Descrição" label-class="text-black">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-id-card text-black"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-button class="btn" type="submit" label="Adicionar opção" theme="success"
                        icon="fas fa-plus" />
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
@stop

@section('js')



@stop
