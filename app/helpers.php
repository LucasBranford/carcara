<?php

use App\Models\Ata;
use App\Models\Entidade;
use App\Models\Gestao;
use App\Models\Oficio;
use App\Models\Portaria;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

function num($doc)
{

    //Pega a entidade do usuário


    $entidade = Auth::user()->entidade_id;

    //Verifica qual o tipo de documento

    //Ofício
    if ($doc == 'ofc') {
        //Pega o número do último documento da entidade do usuário logado

        $numdoc = Oficio::orderBy('numeracao', 'DESC')->where('entidade_id', '=', "$entidade")->limit(1)->get()->toArray();
    }
    //Ata
    if ($doc == 'ata') {
        //Pega o número do último documento da entidade do usuário logado

        $numdoc = Ata::orderBy('numeracao', 'DESC')->where('entidade_id', '=', "$entidade")->limit(1)->get()->toArray();
    }
    if ($doc == 'port') {
        //Pega o número do último documento da entidade do usuário logado

        $numdoc = Portaria::orderBy('numeracao', 'DESC')->where('entidade_id', '=', "$entidade")->limit(1)->get()->toArray();
    }

    if (isset($numdoc)) {
        // Configurar a numeração

        if (isset($numdoc[0]['numeracao'])) {
            $num_exp = explode("/", $numdoc[0]["numeracao"]);
            $num_a = intval($num_exp['0']);

            //Verifica de o ano da numeração anterior é igual ao ano atual
            if ($num_exp['1'] == date('Y')) {
                //Se for, o número X (X/2021) será acrescido de 1. Ex.: 3/2021 -> 4/2021
                $num_a = $num_a + 1;
            } else {
                //Senão, reseta a contrário
                $num_a = 1;
            }
            //Junta a numeração, coloca a barra e o ano atual
            $numdoc = $num_a . '/' . date('Y');
        } else {
            //Reinicia a contagem
            $numdoc = '1/' . date('Y');
        }
    } else {
        //Reinicia a contagem

        $numdoc = '1/' . date('Y');
    }

    return $numdoc;
}



//Retorna a sigla da diretoria do usuário (team_id)
function siglaDir($id)
{
    //Retorna o

    if (isset($id)) {
        $sigla = objToArray(Team::select('name')->where('id', '=', $id)->get());
        $sigla = $sigla['name'];
    } else {
        $sigla = "Estudante";
    }

    return  $sigla;
    // var_dump($cargo);

}

//Retorna sigla da entidade
function siglaEnt($entidade)
{
    //Retorna para a variável $entidade a sigla pelo parâmetro passado
    $entidade = Entidade::find($entidade)->where('id', $entidade)->get();
    $entidade = objToArray($entidade);
    return $entidade['sigla'];
}

//Retorna sigla da entidade
function ent($entidade)
{
    //Retorna para a variável $entidade a sigla pelo parâmetro passado
    $entidade = Entidade::find($entidade)->where('id', $entidade)->get();
    $entidade = objToArray($entidade);
    return $entidade['name'];
}
//Retorna o cargo do usuário (role)
function cargo($id)
{

    $cargo = DB::select('select role_id from role_user where  user_id = ' . $id);
    $cargo = objToArray($cargo);
    $cargo = DB::select('select display_name from roles where id = ' . $cargo['role_id']);
    $cargo = objToArray($cargo);

    return ucwords($cargo['display_name']);
    // var_dump($cargo);

}

function dataBr($data)
{
        $data = date('d-m-Y', $data);

    return $data;
}



function nomecompleto($id)
{

    $nome = DB::select('select role_id from role_user where  user_id = ' . $id);
    $nome = objToArray($nome);
    $nome = DB::select('select name from roles where id = ' . $nome['role_id']);
    $nome = objToArray($nome);

    return $nome;
    // var_dump($cargo);

}

//Função pra tirar o object de dentro do array
function objToArray($data)
{
    $data = json_decode(json_encode($data), true);
    //Coloca o array para a primeira posição
    $data = $data[0];
    return $data;
}


function stdToArray($data)
{
    $data = json_decode(json_encode($data), true);
    //Coloca o array para a primeira posição

    return $data;
}
// Função para pegar a data e colocar no documento
function datadoc()
{
    setlocale(LC_TIME, 'portuguese');
    date_default_timezone_set('America/Fortaleza');
    $data = date('d-m-Y');
    $data = strftime('%d de %B de %Y', strtotime($data));
    echo utf8_encode($data . '.');
}

//Coloca _ para melhor ler o nome do arquivo
function titulodoc($data)
{
    $data = str_replace("/", " ", $data);
    $data = str_replace("º", "", $data);
    $data = str_replace("Í", "I", $data);

    return $data;
}

function gestaoInicio($gestao_id){
    $g = Gestao::find($gestao_id);

    $inicio = explode("-",$g['inicio']);
    return $inicio[0];
    // return $g['inicio'];
}
