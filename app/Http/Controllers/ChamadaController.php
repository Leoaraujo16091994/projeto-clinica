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



        $pacientesPresentes = Pacientes::select('id', 'nome_completo')
                                        ->where($diaSemana, 'on')
                                        ->get();


        $chegaram = Chegada::select('nome_completo')
                            ->where('nome_completo',$pacientesPresentes)
                            ->get();


        return view ('chamarpaciente',['pacientes'=> $pacientesPresentes]);
        




       
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

        return view('/painel',compact('paciente'));

    }

    

    
    public function paineltelacheia()
    {
        $paciente = Chamada::select('nome_completo','sala')
                            -> orderByRaw('created_at DESC')
                            ->get();

        return view('/paineltelacheia',compact('paciente'));
    }




}
