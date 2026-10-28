<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votacao extends Model
{
    use HasFactory;
    protected $table='votacoes';
    protected $fillable= ['name','descricao','gremista','inicio','termino','inicio_validacao','termino_validacao','user_id','ativa'];
}
