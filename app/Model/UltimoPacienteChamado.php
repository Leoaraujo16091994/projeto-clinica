<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UltimoPacienteChamado extends Model
{
  protected $table = 'ultimo_paciente_chamado';

  protected  $fillable =[
    'paciente_pk',
    'created_at'
  ];
}
