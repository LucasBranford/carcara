<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidade extends Model
{
    use HasFactory;
    protected $fillable = ['name','sigla','email','instagram','telefone','unidade_id','endereco','datafundacao','atafundacao','logo','estatuto'];
}
