<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portaria extends Model
{
    use HasFactory;
    protected $fillable = ["titulo","numeracao","resumo","corpo","autor","matricula","cargo",'entidade_id','gestao_id'];
}
