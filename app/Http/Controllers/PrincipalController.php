<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use App\Model\Paciente;
use App\Model\PacienteDoDia;
use Illuminate\Http\Request;


class PrincipalController extends Controller
{

   /* public function inicio(){
        return view('paginainicial');
    }
    */

    public function index (Request $request)
    {    
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

        /*
        $pacientesDoDia = DB::table('paciente')
            ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
            ->select('paciente.*','pacientes_do_dia.*')
            ->where('paciente.nome_completo','like','%'.$nomeCompleto.'%')
            ->where('paciente.dias_semana','=',$diasDaSemana)
            ->where('paciente.turno','=',$turno)
            ->where('paciente.sala','=',$sala)
            ->get();
        */

        $pacientesDoDia = DB::table('paciente')
        ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
        ->select('paciente.*','pacientes_do_dia.*');

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

        return view('/principal', ['pacientesDoDia' => $pacientesDoDia],['requisicao' => $request  ]);
    }
/*
    public function create()
    {
        return view('cadastropaciente');
    }
*/
  
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

    
    
    public function show(Request $request)
    {   
        $nomeCompleto = $request-> nomeCompleto ? $request-> nomeCompleto : null ;
        $diasDaSemana = $request-> diasDaSemana ? $request-> diasDaSemana : null ;
        $turno = $request-> turno ? $request-> turno : null ;
        $sala  = $request-> sala ? $request-> sala : null ;

        $pacientesDoDia = new Paciente([
            'nome_completo' => $nomeCompleto,
            'dias_semana' => $diasDaSemana,
            'turno' => $turno,
            'sala'  => $sala
        ]);

       
        $pacientesDoDia = DB::table('paciente')
            ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
            ->select('paciente.*','pacientes_do_dia.*')
            ->where('paciente.nome_completo','like','%'.$nomeCompleto.'%')
            /*->where()
            ->where()
            ->where() */
            ->get();
            
dd($pacientesDoDia);
//        return view('/principal', ['pacientesDoDia' => $pacientesDoDia]);
                  
    }              
  

  
    public function edit($id)
    {
     /*
        $paciente = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
                                      'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado','id')
                                 ->where('id',$id)
                                 ->get();
       
        return view('editarpaciente', ['paciente' => $paciente]);
      */
    }


    public function update(Request $request, $id)
    {
        $nome = $request-> nomeCompleto;
        $data = $request-> dataNascimento;
        $convenio = $request-> convenio;
        $tsanguineo = $request-> tpSanguineo;
        $status = $request-> status;
        $segunda = $request-> segundaFeira;
        $terca = $request-> tercaFeira;
        $quarta = $request-> quartaFeira;
        $quinta = $request-> quintaFeira;
        $sexta = $request-> sextaFeira;
        $sabado = $request-> sabado;

       
        $pac = Pacientes::find($id);
                
        $paciente = $pac->update([
            'nome_completo' => $nome,
            'data_nascimento' => $data,
            'convenio_paciente' => $convenio,
            'soro_positivo' =>  $tsanguineo,
            'status_paciente' => $status,
            'segunda_feira'=>  $segunda,
            'terca_feira' =>  $terca,
            'quarta_feira' =>  $quarta,
            'quinta_feira' =>  $quinta,
            'sexta_feira'  =>  $sexta,
            'sabado' =>    $sabado,
            'convenio_paciente'=>    $convenio ,
            'soro_positivo' => $tsanguineo,
        ]);

        return view('consultarpaciente');
   
    }




    public function resultadoconsulta(Request $request){
              
        $nome = $request-> nomeCompleto;
        $data = $request-> dataNascimento;
        $paciente = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
                                      'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado','id')
                                ->where('nome_completo',$nome)->where('data_nascimento',$data)
                                ->get();
       
        return view('/resultadoconsultapaciente', ['paciente' => $paciente]);

    }        


   

 }