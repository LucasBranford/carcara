@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Início</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header text-white bg-success  ">
            {{ $votacao['name'] }}
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                  <strong>Informações desta votação</strong>
                </div>
                <div class="card-body">
                  <p class="card-text"><strong>Descrição:</strong> {{$votacao['descricao']}}.</p>
                  <p>Data de início da votação: {{ date('d/m/Y à\s H:i', strtotime($votacao['inicio'])) }}</p>
                  <p>Data de término da votação: {{ date('d/m/Y à\s H:i', strtotime($votacao['termino'])) }}</p>
                  <p>Data de início da validação: {{ date('d/m/Y à\s H:i', strtotime($votacao['inicio_validacao'])) }}</p>
                  <p>Data de término da validação: {{ date('d/m/Y à\s H:i', strtotime($votacao['termino_validacao'])) }}</p>
                                  
                </div>
              </div>
            <div class="card">

                <h5 class="card-header">Opções de Voto</h5>
                <div class="card-body">
                    <div class="row">

                        @foreach ($opcoes as $o)
                            <div class="col-sm-6">
                                <div class="card">


                                    <h5 class="card-header text-white bg-red">{{ $o->name }}</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $o->descricao }}</h5>

                                    </div>
                                    <div class="card-footer text-white bg-success">
                                        <form action="{{ route('voto.store') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="number" hidden name="voto" value="{{ $o->id }}">
                                            <input type="number" hidden name="votacao_id" value="{{ $votacao['id'] }}">
                                            @if ($voto->isEmpty() == true)
                                                <button type="submit" class="btn btn-primary">Votar</a>
                                                @else
                                                    <p>Você já votou nesta eleição!</p>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- div card-body 2 --}}
                    </div>
                </div>
            </div>

            {{-- div card-body 1 --}}
        </div>

    </div>


@stop

@section('css')
@stop

@section('js')



@stop
