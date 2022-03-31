<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    //
    protected $table = "telefone";
    protected $fillable = ['txt_telefone', 'usuario_id'];
}
