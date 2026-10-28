<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficio extends Model
{
    use HasFactory;
    protected $fillable = ["titulo","numeracao","data","entidade_id",'gestao_id',"enderecamento","assunto","corpo","fecho","autor","matricula","cargo"];
    protected $nullable = "assinado";
}
