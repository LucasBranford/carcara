@extends('adminlte::page')

@section('title', 'Ouvidoria Estudantil')

@section('content_header')
    <h1>Ouvidoria Estudantil</h1>
@stop

@section('content')
    <x-adminlte-card title="Nova Manifestação" theme="maroon"    
         footer-class="border-top rounded border-light"
         icon="fas fa-lg fa-bell"
        collapsible maximizable>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-danger">Left</button>
            <button type="button" class="btn btn-warning">Middle</button>
            <button type="button" class="btn btn-success">Right</button>
          </div>
        <x-adminlte-input name="User" placeholder="Username" />
        <x-adminlte-input name="Pass" type="password" placeholder="Password" />
        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="light" label="submit" icon="fas fa-sign-in" />
        </x-slot>




    </x-adminlte-card>
@stop

@section('css')

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
