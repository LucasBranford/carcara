@extends('adminlte::page')
@section('title', 'Minhas Votações')

@section('content_header')
    <h1>Minhas Votações</h1>
@stop

@section('content')
    @php
    use Carbon\Carbon;
    use App\Models\Opcao;
    use App\Models\Nulo;

    @endphp





    <div class="container">
        <div class="row">
            @if(!empty($minhas))
                @foreach ($minhas as $m)
                    <div class="col-lg-4">
                        <div class="card">
                            @if ($m['status'] == 'Ativa')
                                <div class="card-header white-text bg-success">
                                    Eleição ativa
                                </div>
                            @else
                                <div class="card-header white-text bg-danger">
                                    Eleição encerrada
                                </div>
                            @endif


                            <div class="card-body">
                                <h5 class="card-title  text-bold">{{ $m['name'] }}</h5>
                                <p class="card-text"><b>Descrição:</b>{{ $m['descricao'] }}</p>
                                <p>Data de início da votação: {{ date('d/m/Y à\s H:i', strtotime($m['inicio'])) }}</p>
                                <p>Data de término da votação: {{ date('d/m/Y à\s H:i', strtotime($m['termino'])) }}</p>
                                <p>Data de início da validação: {{ date('d/m/Y à\s H:i', strtotime($m['inicio_validacao'])) }}</p>
                                <p>Data de término da validação: {{ date('d/m/Y à\s H:i', strtotime($m['termino_validacao'])) }}</p>
                              
                                @if ($m['termino'] <= Carbon::now())
                                    <x-adminlte-button label="Ver resultados" data-toggle="modal"
                                        data-target="#modal-resultados-{{ $m['id'] }}" class="bg-teal" />
                                    
                                @endif
                                @if ($m['inicio_validacao'] <= Carbon::now() && $m['termino_validacao']>=Carbon::now())
                                <a href="{{ route('votacao.validacao', $m['id']) }}" class="btn bg-warning" />Validação</a>
                                @endif
                                @if ($m['status']=="Encerrada")
                                <a href="{{ route('votacao.listavotantes', $m['id']) }}" class="btn bg-warning" />Lista
                                    de votantes</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($m['termino'] <= Carbon::now())

                    @foreach ($minhas as $g)
                        <x-adminlte-modal id="modal-resultados-{{ $g['id'] }}" title="{{ $g['name'] }}"
                            theme="purple" icon="fas fa-users">

                            @php
                                $opcoes = Opcao::where('votacao_id', '=', $g['id'])->get();
                                
                            @endphp
                            @foreach ($opcoes as $o)
                                <x-adminlte-card title="{{ $o->name }}" theme="teal">

                                    <b>Quantidade de votos: </b>{{ $o->qnt_votos }}<br>

                                </x-adminlte-card>
                            @endforeach

                            <x-adminlte-card title="Total de Votos" theme="primary">
                                @php
                                    // Conta o total de votos
                                    $validos = Opcao::where("votacao_id","=",$g['id'])->sum('qnt_votos');
                                    $nulos = Nulo::where("votacao_id","=",$g['id'])->count();
                                    $total = $validos - $nulos;
                                 @endphp
                                <b>Quantidade total de votos:</b> {{$validos}}<br>
                                <b>Quantidade de votos nulos:</b> {{$nulos}}<br>
                                <b>Quantidade de total de votos válidos:</b> {{$total}}

                            </x-adminlte-card>



                            <x-slot name="footerSlot">
                                @if ($m['status'] == 'Ativa')

                                <form action="{{ route('votacao.encerrar', $g['id']) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" hidden value="Encerrada" name="status">
                                    <x-adminlte-button theme="success" label="Encerrar eleição" type="submit" />
                                </form>
                                @endif
                                <x-adminlte-button theme="danger" label="Fechar" data-dismiss="modal" />
                            </x-slot>
                        </x-adminlte-modal>
                    @endforeach
                @endif
             
            @endif



        @stop

        @section('css')
        @stop

        @section('js')

        <script>
            $(document).ready(function()
            {
                // Read flag from the controller.
                let shouldFire = @json($fireAlert);
        
                if (shouldFire) {
                    Swal.fire('Opa!', 'Parece que você não tem nenhuma votação', 'error');
                }
        
            });
        </script>

        @stop
