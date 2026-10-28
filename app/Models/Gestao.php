<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestao extends Model
{
    protected $table = "gestoes";
    protected $fillable = ["name","atadeposse", "inicio","termino","entidade_id"];
    
    use HasFactory;

}
