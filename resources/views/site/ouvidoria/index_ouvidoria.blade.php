@extends('adminlte::page')

@section('title', 'Ouvidoria Estudantil')

@section('content_header')
    <h1>Ouvidoria Estudantil</h1>
@stop

@section('content')
    <x-adminlte-card title="Boas vindas!" theme="purple" icon="fas fa-lg fa-fan">
        Boas-vindas à Ouvidoria Estudantil do SIAG-REGIF! Aqui você pode registrar manifestações a serem analisadas pelo(a)
        Ouvidor(a). Manifestações incluem elogios, denúncias, reclamações e pedidos de acesso à informação.

        <x-adminlte-card title="Registre sua Manifestação" theme="purple" icon="fas fa-lg fa-fan">
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic mixed styles example">
                <x-adminlte-button label="Acesso à Informação" theme="info" data-toggle="modal" data-target="#modalInfo" />
                <x-adminlte-button label="Denúncia" theme="danger" data-toggle="modal" data-target="#modalMin" />
                <x-adminlte-button label="Elogio" theme="primary" data-toggle="modal" data-target="#modalMin" />
                <x-adminlte-button label="Reclamação" theme="warning" data-toggle="modal" data-target="#modalMin" />
                <button type="button" class="btn btn-primary">Primary</button>
                <button type="button" class="btn btn-roxo">Primary</button>
                {{-- Modal de Acesso à Informação --}}
                
                <x-adminlte-modal id="modalInfo" title="Pedido de Acesso à Informação" theme="info" icon="fas fa-info-circle"
                    v-centered static-backdrop scrollable>
 
                    <div style="height:800px;">Read the account policies...</div>
                    <x-slot name="footerSlot">
                        <x-adminlte-button class="mr-auto" theme="success" label="Accept" />
                        <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" />
                    </x-slot>
                </x-adminlte-modal>

                {{-- Modal de Denúncia --}}
                <x-adminlte-modal id=" " title="Account Policy" size="lg" theme="teal" icon="fas fa-bell"
                    v-centered static-backdrop scrollable>
                    <div style="height:800px;">Read the account policies...</div>
                    <x-slot name="footerSlot">
                        <x-adminlte-button class="mr-auto" theme="success" label="Accept" />
                        <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" />
                    </x-slot>
                </x-adminlte-modal>

                {{-- Modal de Elogio --}}
                <x-adminlte-modal id="modalCustom" title="Account Policy" size="lg" theme="teal" icon="fas fa-bell"
                    v-centered static-backdrop scrollable>
                    <div style="height:800px;">Read the account policies...</div>
                    <x-slot name="footerSlot">
                        <x-adminlte-button class="mr-auto" theme="success" label="Accept" />
                        <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" />
                    </x-slot>
                </x-adminlte-modal>
                {{-- Modal de Reclamação --}}
                <x-adminlte-modal id="modalCustom" title="Account Policy" size="lg" theme="teal" icon="fas fa-bell"
                    v-centered static-backdrop scrollable>
                    <div style="height:800px;">Read the account policies...</div>
                    <x-slot name="footerSlot">
                        <x-adminlte-button class="mr-auto" theme="success" label="Accept" />
                        <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" />
                    </x-slot>
                </x-adminlte-modal>
            </div>
        </x-adminlte-card>
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
