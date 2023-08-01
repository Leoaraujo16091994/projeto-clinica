<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
  protected $table = 'paciente';

  protected  $fillable =[
      'nome_completo',
      'dias_semana',
      'turno',
      'sala'
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
