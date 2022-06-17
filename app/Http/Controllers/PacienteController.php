<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use App\Model\Paciente;
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
        $diasDaSemana = $request-> diasSemana;
        $turno = $request-> turno;
        $sala = $request-> sala;
       
        $pac = Paciente::find($id);
                
        $paciente = $pac->update([
            'nome_completo' => $nomeCompleto,
            'dias_semana'  => $diasDaSemana,
            'turno'  => $turno,
            'sala'  => $sala
        ]);

        return redirect('/paciente');
    }


    public function destroy(Request $request){
        DB::table('pacientes_do_dia')->where('paciente_pk', $request->idPacienteExcluido)->delete();
        DB::table('ultimo_paciente_chamado')->where('paciente_pk', $request->idPacienteExcluido)->delete();
        DB::table('paciente')->where('id', $request->idPacienteExcluido)->delete();
        
        $pacientes = DB::table('paciente')->orderBy('nome_completo', 'ASC')->get();

        return back()->withInput();
    }

    /*              
    public function resultadoconsulta(Request $request){
        $nome = $request-> nomeCompleto;
        $data = $request-> dataNascimento;
        $paciente = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
                                      'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado','id')
                                ->where('nome_completo',$nome)->where('data_nascimento',$data)
                                ->get();
       
        return view('/resultadoconsultapaciente', ['paciente' => $paciente]);

    }   
    */
       
 }