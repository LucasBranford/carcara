<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{
    use HasFactory;
    protected $table="opcoes";
    protected $fillable=["name","descricao","votacao_id","qnt_votos"];
}
