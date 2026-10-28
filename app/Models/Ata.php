<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ata extends Model
{
    use HasFactory;
    protected $fillable = ['numeracao','titulo','convocacao','secretaria','tipo','data_reuniao','horario_reuniao','local','pautas',
    'encaminhamentos','temporalidade','presentes','corpo','autor','orgao','matricula','cargo','entidade_id','gestao_id'];

}
