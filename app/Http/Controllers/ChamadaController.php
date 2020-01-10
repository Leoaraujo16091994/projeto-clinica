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
        date_default_timezone_set('America/Fortaleza');

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
        
        
        return redirect('chamarpainel/create');
    }



    public function pacientesFaltaram(){
        $dia = date('w');

        // Pacientes que faltaram de Segunda a Sabado
            if ($dia == 1){
                $pacFaltaram = \DB::table('pacientes as pac')->select('pac.nome_completo')
                                -> where ('pac.segunda_feira','on')
                                -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = pac.nome_completo 
                                            and 'chamada.created_at' = '".date('Y-m-d')."')")
                                ->get();

            } else if($dia == 2){
                $pacFaltaram = \DB::table('pacientes as pac')->select('pac.nome_completo')
                                -> where ('pac.terca_feira','on')
                                -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = pac.nome_completo 
                                            and 'chamada.created_at' = '".date('Y-m-d')."')")
                                ->get();

            } else if($dia == 3){
                $pacFaltaram = \DB::table('pacientes as pac')->select('pac.nome_completo')
                                -> where ('pac.quarta_feira','on')
                                -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = pac.nome_completo 
                                            and 'chamada.created_at' = '".date('Y-m-d')."')")
                                ->get();

            } else if($dia == 4){
                $pacFaltaram = \DB::table('pacientes as pac')->select('pac.nome_completo')
                                -> where ('pac.quinta_feira','on')
                                -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = pac.nome_completo 
                                            and 'chamada.created_at' = '".date('Y-m-d')."')")
                                ->get();

            } else if($dia == 5){
                $pacFaltaram = \DB::table('pacientes as pac')->select('pac.nome_completo')
                                -> where ('pac.sexta_feira','on')
                                -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = pac.nome_completo 
                                            and 'chamada.created_at' = '".date('Y-m-d')."')")
                                ->get();

            } else if($dia == 6){
                $pacFaltaram = \DB::table('pacientes as pac')->select('pac.nome_completo')
                                -> where ('pac.sabado','on')
                                -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = pac.nome_completo 
                                            and 'chamada.created_at' = '".date('Y-m-d')."')")
                                ->get();

            } 

    }





    public function fetch(Request $request)
     {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = Pacientes::select('nome_completo')
                    ->where('nome_completo', 'LIKE', "%{$query}%")->limit(3)
                    ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)    {
                    $output .= '
                    <li><a href="#">'.$row->nome_completo.'</a></li>
                    ';
                }   
            $output .= '</ul>';
            echo $output;
        }
    }



    }
