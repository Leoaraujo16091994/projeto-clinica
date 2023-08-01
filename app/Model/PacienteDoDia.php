<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PacienteDoDia extends Model
{
  protected $table = 'pacientes_do_dia';

  protected  $fillable =[
      'paciente_pk',
      'chegou',
      'chamado',
      'observacao',
      'sala_do_dia',
      'chamar_acompanhante',
      'chamado_painel',
      'created_at',
      'updated_at',
      'turno_do_dia'
  ];


    public static function getBuscarPacientesDoDia(Request $request)
    {
      
      $idUser = auth()->user()->id;  

      $nomeCompleto = $request-> nomeCompleto ? $request-> nomeCompleto : "" ;
      $diasDaSemana = $request-> diasDaSemana ? $request-> diasDaSemana : null ;
      $turno = $request-> turno ? $request-> turno : "" ;
      $sala  = $request-> sala ? $request-> sala : "" ;

      if($idUser != 6) { // usuario diferente de recepcao
          $pacientesDoDia = DB::table('paciente')
              ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
              ->select('paciente.*','pacientes_do_dia.*')
              ->whereDate('pacientes_do_dia.created_at', date('Y-m-d'))
              ->where('pacientes_do_dia.sala_do_dia',$idUser);
      } else {
          $pacientesDoDia = DB::table('paciente')
              ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
              ->select('paciente.*','pacientes_do_dia.*')
              ->whereDate('pacientes_do_dia.created_at', date('Y-m-d'));
              }

      if($nomeCompleto){
          $pacientesDoDia -> where('paciente.nome_completo','like','%'.$nomeCompleto.'%');
      }

      if($diasDaSemana){
          $pacientesDoDia ->where('paciente.dias_semana','=',$diasDaSemana);
      }

      if($turno){
          $pacientesDoDia ->where('pacientes_do_dia.turno_do_dia','=',$turno);
      }

      if($sala){
          $pacientesDoDia ->where('pacientes_do_dia.sala_do_dia','=',$sala);
      }

      return $pacientesDoDia->get();
    }

}
