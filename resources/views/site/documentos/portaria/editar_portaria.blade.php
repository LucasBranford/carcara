@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Novo Ofício</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('portaria.update',$port->id) }}" method="post">
                @csrf
                @method('put')


                <div class="m-5">
                     <label for="titulo">Título</label>
                    <input class="form-control" name="titulo" required id="titulo" type="text" placeholder=""
                        value="{{$port->titulo}}">
                    <label for="titulo">Resumo</label>

                    <input class="form-control" name="resumo" required id="resumo" type="text" placeholder=""
                        value="{{$port->resumo}}">

                    <label for="input-texto">Corpo do texto
                    </label>
                    <textarea name="corpo" required id="input-texto" type="text" spellcheck="true">{{$port->corpo}}</textarea>
                </div>




                <div class="card border-danger mb-3"
                    style="min-width:12rem;max-width: 18rem;position: relative;margin-right:auto;margin-left:auto;"
                    id="input-card">
                    <div class="card-body text-danger">
                        <h5 class="card-title">Terminou a ata? </h5>
                        <p class="card-text">Lembre-se:<br>Documentos só valem após assinados!</p>
                        <input type="submit" class="btn btn-danger" value="Salvar ata">
                    </div>

            </form>

        </div>

    </div>
    </div>






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
