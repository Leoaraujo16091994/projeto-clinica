<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{

    protected $table = 'funcionarios';
    protected $fillable = ['nome_completo','cargo','id','senha'];
    public $timestamps = false;



}
