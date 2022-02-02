<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PacienteDoDia extends Model
{
  protected $table = 'paciente_do_dia';

  protected  $fillable =[
      'paciente_pk',
      'chegou',
      'chamado',
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
