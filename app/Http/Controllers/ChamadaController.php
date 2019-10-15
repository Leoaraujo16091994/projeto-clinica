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


        $pacientesPresentes = \DB::table('pacientes as p')->select('p.id', 'p.nome_completo')
            -> join('chegada as c', 'c.nome_completo', '=', 'p.nome_completo')
            -> join('chamada as chamada', 'chamada.nome_completo','!=','c.nome_completo')
            -> where('p.'.$diaSemana, 'on')
            -> whereRaw("date(c.created_at) = '".date('Y-m-d')."'")
            -> whereRaw("date(chamada.created_at) = '".date('Y-m-d')."'")
            -> get();    
 
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
