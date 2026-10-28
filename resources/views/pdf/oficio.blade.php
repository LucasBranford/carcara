<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>{{ $data['titulo'] }}</title>

</head>

<body>
    @component('pdf.components.oficioheader')

    @endcomponent


    <div class="numeracao margens" style="padding-top:2mm">
        <b>{{ $data['titulo'] }}</b>
    </div>

    <div class="data margens" style="text-align:right">
        {{ $data['data'] }}
    </div>

    <div class="enderecamento margens" style="text-align:justify; padding-bottom:5mm;">
        <pre style="white-space: pre-wrap; font-family:LiberationSerif; width: 170mm; ">{{$data['enderecamento']}} </pre>
    </div>

    <div class="assunto margens" style="text-align:left;padding-bottom:5mm">
      <b>Assunto:  {{ $data['assunto'] }} </b>
    </div>

    <div class="corpo margens" style="padding-bottom:5mm;  " >
        {{htmlteste($data['corpo'])}}

    </div>

    <div class= "fecho margens" style="text-align:left;padding-bottom:2mm">
        {{$data['fecho']}}
    </div>


    <div class= "autor margens" style="text-align:center;padding-left:auto;padding-right:auto">
        {{$data['autor']}}<br>
        {{$data['cargo']}}<br>
        {{$data['matricula']}}

    </div>


    <!--  <header>
        <div class="unidadeensino"> INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO RIO GRANDE DO NORTE <br>
            CÂMPUS MOSSORÓ - IFRN-MO
        </div>
        <div class="header-entidade"> Grêmio Estudantil Valdemar dos Pássaros </div>
        <div class="cnpj"> CNPJ: 123456789 </div>
        <div class="gestao"><i> Gestão 2019-2021 - IF Para Tempos de Guerra </i></div>
    </header>-->


</body>

</html>
