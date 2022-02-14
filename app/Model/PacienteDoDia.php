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
      'sala_paciente_extra',
      'created_at'
  ];
/*
  public function chamadas()
  {
    return $this->hasMany('App\Model\Chamada', 'nome_completo', 'nome_completo');
  }

  public function carasDoDia($var)
  {
    # code...
  }
  */
}
