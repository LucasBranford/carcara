<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nulo extends Model
{
    use HasFactory;
    protected $fillable=["votante","votacao_id","user_id","justificativa"];
}
