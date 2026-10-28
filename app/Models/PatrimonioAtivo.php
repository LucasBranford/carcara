<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatrimonioAtivo extends Model
{
    use HasFactory;
    protected $table = "patrimonioativo";
    protected $fillable = ["name","identificacao","observacao","obtencao","custo", "emprestavel","gremista","entidade_id"]; 
}
