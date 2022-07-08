<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PacienteDoDia extends Model
{
  protected $table = 'pacientes_do_dia';

  protected  $fillable =[
      'paciente_pk',
      'chegou',
      'chamado',
      'observacao',
      'sala_do_dia',
      'created_at',
      'updated_at',
      'turno_do_dia'
  ];
}
