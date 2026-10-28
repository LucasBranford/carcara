
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>{{ $data['titulo'] }}</title>


</head>

<body>

    INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO RIO GRANDE DO NORTE
     {{-- <br> --}}
    @if($entidade['name']== "Rede de Grêmios do IFRN")

    @else
     -<br> {{ucwords($unidade['name'])}} - {{$unidade['sigla']}}

    @endif
    <br>
    <br>
    <b>{{ $entidade['name'] }}</b>
    <br>
    {{-- CNPJ: {{ $entidade['cnpj'] }}<br> --}}
    <i>Gestão {{gestaoInicio($gestao['id'])}} - {{$gestao['name']}} </i>

