<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
  protected $table = 'pacientes';

  protected  $fillable =[
      'nome_completo',
      'data_nascimento',
      'convenio_paciente',
      'soro_positivo',
      'status_paciente',
      'segunda_feira',
      'terca_feira',
      'quarta_feira',
      'quinta_feira',
      'sexta_feira',
      'sabado'

  ];

  public function chamadas()
  {
    return $this->hasMany('App\Model\Chamada', 'nome_completo', 'nome_completo');
  }

  public function carasDoDia($var)
  {
    # code...
  }
}
