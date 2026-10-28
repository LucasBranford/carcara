@extends('adminlte::page')
@section('title', 'Votar')

@section('content_header')
    <h1>Votação</h1>
@stop

@section('content')
    <div class="card text-center">
        <div class="card-header">
            Digite aqui o código da eleição
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <input type="text" id='input' name="codigo"> <br> <br>
            <a   id="button" class="btn btn-primary">Encaminhar para votação</a>
        </div>
        <div class="card-footer text-muted">

        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

    @push('js')

    <script type="text/javascript">

        $(document).ready(function(){

            $('#button').click(function(e) {
                var inputvalue = $("#input").val();
                window.location.replace(" https://carcara.org.br/votacao/urna/"+inputvalue);

            });
        });
        </script>

        <script>
            $(document).ready(function()
            {
                // Read flag from the controller.
                let shouldFire = @json($fireAlert);

                if (shouldFire) {
                    Swal.fire('Opa!', 'A eleição ainda não começou ou já terminou.', 'danger');
                }

            });
        </script>

    @endpush

@stop
