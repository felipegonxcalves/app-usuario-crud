<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = "endereco";
    protected $fillable = ['cep', 'logradouro', 'complemento', 'numero', 'cidade', 'estado', 'pais'];
}
