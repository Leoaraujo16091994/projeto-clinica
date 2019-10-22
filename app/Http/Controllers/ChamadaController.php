<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Chamada;
use App\Model\Chegada;
use App\Model\Pacientes;

class ChamadaController extends Controller
{

    public function create()
    {
        date_default_timezone_set('America/Fortaleza');
        $diaSemana = null;
        switch (date('w')) {
            case '0':
                $diaSemana = 'segunda_feira';
                break;
            case '1':
                $diaSemana = 'segunda_feira';
                break;
            case '2':
                $diaSemana = 'terca_feira';
                break;
            case '3':
                $diaSemana = 'quarta_feira';
                    break;    
            case '4':
                $diaSemana = 'quinta_feira';
                break;
            case '5':
                $diaSemana = 'sexta_feira';
                break;
            case '6':
                $diaSemana = 'sabado';
                break;
        }


        $pacientesPresentes = \DB::table('chegada as c')->select('c.nome_completo')
            -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = c.nome_completo and date(chamada.created_at) = '".date('Y-m-d')."')")
            -> whereRaw("date(c.created_at) = '".date('Y-m-d')."'")
            -> get();

$cont = count($pacientesPresentes);


        return view ('chamarpaciente',['pacientes'=> $pacientesPresentes],['contador'=> $cont]);
    
    }

  
    public function store(Request $request)
    {
        $nome = $request -> nomeCompleto;
        $sala = $request -> sala;
        $atend = $request -> chamada;



       if($atend == NULL)
            $atend = 'P';



        $paciente = new Chamada([
            'nome_completo' => $nome,
            'sala' => $sala,
            'status' => $atend,
            
            ]);

        $paciente ->save();
        
        return redirect('chamarpainel/create');
     
    }

   
    public function exibirpainel(Request $request)
    {

        $paciente = Chamada::select('nome_completo','sala')
                            ->orderByRaw('created_at DESC')
                            ->get();

                            $qtdPacientes;

                            if($paciente ->isEmpty()){
                                $qtdPacientes = 0 ;    
                            } 
                            else if (count($paciente) == 1){
                                $qtdPacientes = 1 ;
                            }
                            else if (count($paciente) == 2){
                                $qtdPacientes = 2 ; 
                            }
                            else {
                                $qtdPacientes = 3 ;
                            }    
        



   return view('/painel',compact('paciente'),compact ('qtdPacientes'));

    }

    

    
    public function paineltelacheia()
    {
        $paciente = Chamada::select('nome_completo','sala')
                            -> orderByRaw('created_at DESC')
                            ->get();


        
        $qtdPacientes;

        if($paciente ->isEmpty()){
            $qtdPacientes = 0 ;    
        } 
        else if (count($paciente) == 1){
            $qtdPacientes = 1 ;
        }
        else if (count($paciente) == 2){
            $qtdPacientes = 2 ; 
        }
        else {
            $qtdPacientes = 3 ;
        }    

        return view('/paineltelacheia',compact('paciente'),compact ('qtdPacientes'));
    }

  


    public function deletar()
    {
        $id = Chamada::max('id');
            
        $var = Chamada::find($id);
        $var->delete();
        
        /*

        if($var)
            return "Ultimo Paciente Removido";
        else
            return "Erro ao remover ultimo paciente";
        */
        
        return redirect('chamarpainel/create');
    }


}
