<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use App\Model\Paciente;
use App\Model\PacienteDoDia;
use Illuminate\Http\Request;



class PacienteController extends Controller
{
  

    public function index (Request $request)
    {
        $nomeCompleto = $request-> nomeCompleto ? $request-> nomeCompleto : "" ;
        $diasDaSemana = $request-> diasDaSemana ? $request-> diasDaSemana : null ;
        $turno = $request-> turno ? $request-> turno : "" ;
        $sala  = $request-> sala ? $request-> sala : "" ;

        $pacientes = new Paciente([
            'nome_completo' => $nomeCompleto,
            'dias_semana' => $diasDaSemana,
            'turno' => $turno,
            'sala'  => $sala
        ]);

            $pacientes = DB::table('paciente')->orderBy('nome_completo', 'ASC');
                                

        if($nomeCompleto){
            $pacientes -> where('paciente.nome_completo','like','%'.$nomeCompleto.'%');
        }

        if($diasDaSemana){
            $pacientes ->where('paciente.dias_semana','=',$diasDaSemana);
        }

        if($turno){
            $pacientes ->where('paciente.turno','=',$turno);
        }

        if($sala){
            $pacientes ->where('paciente.sala','=',$sala);
        }

        $pacientes =  $pacientes->get();
       
            return view('paciente.index',['pacientes' => $pacientes],['requisicao' => $request]);

    }

    public function create()
    {
    }

  
    public function store(Request $request)
    {  
        
          $nomeCompleto= $request-> nomeCompleto;
          $diasDaSemana = $request-> diasDaSemana;
          $turno = $request-> turno;
          $sala  = $request-> sala;
  
          $paciente = new Paciente([
              'nome_completo' => $nomeCompleto,
              'dias_semana' => $diasDaSemana,
              'turno' => $turno,
              'sala'  => $sala
          ]);
  
          $paciente->save();

          $request = new Paciente([
            'nome_completo' =>'',
            'dias_semana' =>'',
            'turno' =>'',
            'sala'  =>''
        ]);

        $pacientes = DB::table('paciente')->orderBy('nome_completo', 'ASC')->get();

        return view('paciente.index',['pacientes' => $pacientes],['requisicao' => $request]);
       
    }

    
    
    public function show($id)
    {   
        $paciente = Paciente::where('id',$id)->get();
        return view('paciente.edit',['pacienteSelecionado' => $paciente]);
    }              
  
  
    public function edit($id){
         
    }


    public function update(Request $request, $id)
    {
  
        $nomeCompleto = $request-> nomeCompleto;
        $diasDaSemana = $request-> diasDaSemana;
        $turno = $request-> turno;
        $sala = $request-> sala;
     
        $pac = Paciente::find($id);
                
        $paciente = $pac->update([
            'nome_completo' => $nomeCompleto,
            'dias_semana'  => $diasDaSemana,
            'turno'  => $turno,
            'sala'  => $sala
        ]);
        
        $this->ajustarPacienteNaListaPacientesDoDia($pac);
        
        
        return redirect('/paciente');
    }
    
    
    
    public function ajustarPacienteNaListaPacientesDoDia($paciente){
        
        $dia = date('w'); 
        $pacienteExiste = DB::table('pacientes_do_dia')
                            ->whereDate('pacientes_do_dia.created_at', date('Y-m-d'))
                            ->where('pacientes_do_dia.paciente_pk',$paciente->id)->exists();
        

        if($paciente->dias_semana == 1 && ($dia == 1 || $dia == 3 || $dia == 5)){ // paciente é de segunda e hoje é segunda
            if(!$pacienteExiste){  // crio paciente hoje pq paciente era de terça e nao existe 
                $paciente = new PacienteDoDia([
                    'paciente_pk' => $paciente->id,
                    'chegou' => 1,
                    'chamado' => 1,
                    'sala_do_dia' => $paciente->sala,
                    'turno_do_dia' => $paciente->turno
                ]);
        
                $paciente->save();
            }else { // caso tenha alterado somente a o nome,turno ou sala
                $pacienteJaCadastrado = PacienteDoDia::whereDate('pacientes_do_dia.created_at', date('Y-m-d'))
                                                        ->where('pacientes_do_dia.paciente_pk',$paciente->id)
                                                            ->update([
                                                                    'turno_do_dia'  => $paciente->turno,
                                                                    'sala_do_dia'  => $paciente->sala,
                                                                ]);
                                                              
            }
        }

        if($paciente->dias_semana == 2 && ($dia == 1 || $dia == 3 || $dia == 5)){ // caso o paciente tenha mudado de dia
           DB::table('pacientes_do_dia')->where('paciente_pk', $paciente->id)->delete();
        }









        if($paciente->dias_semana == 2 && ($dia == 2 || $dia == 4 || $dia == 6)){
           
            if(!$pacienteExiste){  // crio paciente hoje pq paciente era de terça e nao existe 
                $paciente = new PacienteDoDia([
                    'paciente_pk' => $paciente->id,
                    'chegou' => 1,
                    'chamado' => 1,
                    'sala_do_dia' => $paciente->sala,
                    'turno_do_dia' => $paciente->turno
                ]);
        
                $paciente->save();
            }else { // caso tenha alterado somente a o nome,turno ou sala
                    $pacienteJaCadastrado = PacienteDoDia::whereDate('pacientes_do_dia.created_at', date('Y-m-d'))
                                                            ->where('pacientes_do_dia.paciente_pk',$paciente->id)
                                                            ->update([
                                                                    'turno_do_dia'  => $paciente-> turno,
                                                                    'sala_do_dia'  => $paciente-> sala
                                                                ]);
                }
        }
        
        if($paciente->dias_semana == 1 && ($dia == 2 || $dia == 4 || $dia == 6)){// caso o paciente tenha mudado de dia
           DB::table('pacientes_do_dia')->where('paciente_pk', $paciente->id)->delete();
        }
   
    }


    public function destroy(Request $request){
        DB::table('pacientes_do_dia')->where('paciente_pk', $request->idPacienteExcluido)->delete();
        DB::table('ultimo_paciente_chamado')->where('paciente_pk', $request->idPacienteExcluido)->delete();
        DB::table('paciente')->where('id', $request->idPacienteExcluido)->delete();
        
        $pacientes = DB::table('paciente')->orderBy('nome_completo', 'ASC')->get();

        return back()->withInput();
    }
  
}