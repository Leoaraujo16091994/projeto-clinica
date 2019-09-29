<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    protected $table = 'chamada';
    protected $fillable = ['nome_completo','sala','status'];
}
