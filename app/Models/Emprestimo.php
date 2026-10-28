<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable=["patrimonio_id","data_devolucao","matricula","name","gremista_emprestou",
    "gremista_devolvido","status"];
    

    
}
