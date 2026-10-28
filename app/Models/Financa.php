<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financa extends Model
{
    use HasFactory;
    protected $table = "financas";
    protected $fillable = ['mododepagamento','tipo','valor','participante',
    'cpfparticipante','gremista','cpfgremista','identificacao','comprovante','entidade_id'];
}
