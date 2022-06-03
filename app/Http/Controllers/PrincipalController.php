<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use App\Model\Paciente;
use App\Model\PacienteDoDia;
use Illuminate\Http\Request;


class PrincipalController extends Controller
{

  

    public function index (Request $request)
    {    
        $idUser = auth()->user()->id;
        

        $nomeCompleto = $request-> nomeCompleto ? $request-> nomeCompleto : "" ;
        $diasDaSemana = $request-> diasDaSemana ? $request-> diasDaSemana : null ;
        $turno = $request-> turno ? $request-> turno : "" ;
        $sala  = $request-> sala ? $request-> sala : "" ;

        $pacientesDoDia = new Paciente([
            'nome_completo' => $nomeCompleto,
            'dias_semana' => $diasDaSemana,
            'turno' => $turno,
            'sala'  => $sala
        ]);

        $pacientesDoDia = DB::table('paciente')
                    ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
                    ->select('paciente.*','pacientes_do_dia.*')
                    ->whereDate('pacientes_do_dia.created_at', date('Y-m-d'))
                    ->where('pacientes_do_dia.sala_do_dia',$idUser);


        if($nomeCompleto){
            $pacientesDoDia -> where('paciente.nome_completo','like','%'.$nomeCompleto.'%');
        }

        if($diasDaSemana){
            $pacientesDoDia ->where('paciente.dias_semana','=',$diasDaSemana);
        }

        if($turno){
            $pacientesDoDia ->where('paciente.turno','=',$turno);
        }

        if($sala){
            $pacientesDoDia ->where('paciente.sala','=',$sala);
        }

        $pacientesDoDia =  $pacientesDoDia->get();

        return view('/principal', ['pacientesDoDia' => $pacientesDoDia],['requisicao' => $request]);
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
   
        return redirect('principal');
    }


    public function todosPacientes()
    {
        $todosPaciente = Paciente::all();
        
        $output = '<select>';
        
        foreach($todosPaciente as $paciente)
        { 
            $output .= '<option value =' .$paciente->id.' >'.$paciente->nome_completo.'</option>';
        }
        $output .= '</select>';
       
        echo $output;
    }
        


    public function storePacienteExtra(Request $request)
    {
        $idPacienteExtra = $request-> paciente;
        $salaDoPaciente = $request -> salaPacienteExtra;
     
        $paciente = new PacienteDoDia([
            'paciente_pk' => $idPacienteExtra,
            'chegou' => 1,
            'chamado' => 1,
            'sala_do_dia' => $salaDoPaciente
        ]);

        $paciente->save();
   
        return redirect('principal');
    }

    
    
    public function show(Request $request)
    {   

        dd($request);
    }              
  

  
    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        $observacao = $request->observacao;
      
        $pac = PacienteDoDia::find($id);
       
        $pacienteChegou = $request -> chegadaPaciente;
        $pacienteChamado = $request -> chamadaPaciente;

        if($pacienteChegou){
            $paciente = $pac->update([
                'observacao' => $observacao,
                'chegou' => 2
            ]);
        }

        if($pacienteChamado){
            $paciente = $pac->update([
                'chamado' => 2
            ]);
        }
        
       
        return redirect('principal');
   
    }

 }