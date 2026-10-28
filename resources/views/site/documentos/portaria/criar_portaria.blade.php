@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Novo Ofício</h1>
@stop

@section('content')
    {{-- <div class="card"> --}}
        {{-- <div class="card-body"> --}}
            <form action="{{ route('portaria.store') }}" method="post">
                @csrf
                @method('post')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="m-5">
                    <input hidden name="numeracao" readonly type="text" value="{{ num('port') }}" required>
                    <label for="titulo">Título</label>
                    <input readonly class="form-control" name="titulo" required id="titulo" type="text"
                        placeholder=""
                        value="PORTARIA Nº {{ num('port') }}/{{ strtoupper(siglaDir(Auth::user()->team_id) . '/' . siglaEnt(Auth::user()->entidade_id)) }}">
                    <label for="titulo">Resumo</label>

                    <input class="form-control" name="resumo" required id="resumo" type="text" placeholder=""
                        value="">

                    <label for="input-texto">Corpo do texto
                    </label>
                    <textarea name="corpo" required id="input-texto" type="text" spellcheck="true"></textarea>
                </div>




                <div class="card border-danger mb-3"
                    style="min-width:12rem;max-width: 18rem;position: relative;margin-right:auto;margin-left:auto;"
                    id="input-card">
                    <div class="card-body text-danger">
                        <h5 class="card-title">Terminou a Portaria? </h5>
                        <p class="card-text">Lembre-se:<br>Documentos só valem após assinados!</p>
                        <input type="submit" class="btn btn-danger" value="Salvar Portaria">
                    </div>

            </form>

        {{-- </div> --}}

    {{-- </div> --}}
     






@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/documentos.css') }}">

@stop



@section('js')


    <script>
        $(function() {
            CKEDITOR.replace('corpo', {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='



            });


        });
    </script>
@stop
