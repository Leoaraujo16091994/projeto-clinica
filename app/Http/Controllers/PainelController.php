<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use App\Model\Paciente;
use App\Model\PacienteDoDia;
use App\Model\UltimoPacienteChamado;
use Illuminate\Http\Request;


class PainelController extends Controller
{

    public function index ()
    {    
        $pacientesDoDia = DB::table('paciente')
                ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
                ->select('paciente.sala', 
                        (DB::raw('MAX(pacientes_do_dia.paciente_pk) idDoPaciente')), 
                        (DB::raw('MAX(pacientes_do_dia.updated_at) ultimoAtualizado')),
                        (DB::raw("(SELECT paciente.nome_completo FROM paciente WHERE paciente.id = MAX(pacientes_do_dia.paciente_pk)) nome_completo"))
                )
                ->where('pacientes_do_dia.chamado', '=', '2')
                ->groupBy('paciente.sala')
                ->get();


            $ultimoPacienteChamado = DB::table('paciente')
            ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
            ->select('paciente.sala', 
                    (DB::raw('MAX(pacientes_do_dia.paciente_pk) idDoPaciente')), 
                    (DB::raw('MAX(pacientes_do_dia.updated_at) ultimoAtualizado')),
                    (DB::raw("(SELECT paciente.nome_completo FROM paciente WHERE paciente.id = MAX(pacientes_do_dia.paciente_pk)) nome_completo"))
            )
            ->where('pacientes_do_dia.chamado', '=', '2')
            ->groupBy('paciente.sala')
            ->orderByDesc('pacientes_do_dia.updated_at')
            ->limit(1)
            ->get();


    return view('/novoPainel',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' => $ultimoPacienteChamado]);
       
    }

    public function create()
    {
    }
  
    public function store(Request $request)
    {
    }

    
    
    public function show()
    {   
        $pacientesDoDia = DB::table('paciente')
        ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
        ->select('paciente.sala', 
                (DB::raw('MAX(pacientes_do_dia.paciente_pk) idDoPaciente')), 
                (DB::raw('MAX(pacientes_do_dia.updated_at) ultimoAtualizado')),
                (DB::raw("(SELECT paciente.nome_completo FROM paciente WHERE paciente.id = MAX(pacientes_do_dia.paciente_pk)) nome_completo"))
        )
        ->where('pacientes_do_dia.chamado', '=', '2')
        ->groupBy('paciente.sala')
        ->get();
        
        $ultimoPacienteChamado = DB::table('paciente')
            ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
            ->select('paciente.sala', 
                    (DB::raw('MAX(pacientes_do_dia.paciente_pk) idDoPaciente')), 
                    (DB::raw('MAX(pacientes_do_dia.updated_at) ultimoAtualizado')),
                    (DB::raw("(SELECT paciente.nome_completo FROM paciente WHERE paciente.id = MAX(pacientes_do_dia.paciente_pk)) nome_completo"))
            )
            ->where('pacientes_do_dia.chamado', '=', '2')
            ->groupBy('paciente.sala')
            ->orderByDesc('pacientes_do_dia.updated_at')
            ->limit(1)
            ->get();

            $ultimoPacienteChamadoSalvo= DB::table('ultimo_paciente_chamado')
                ->select('ultimo_paciente_chamado.paciente_pk')
                ->orderByDesc('ultimo_paciente_chamado.updated_at')
                ->limit(1)
                ->get();

   
              if($ultimoPacienteChamado[0]->idDoPaciente != $ultimoPacienteChamadoSalvo[0]->paciente_pk ){
                        $paciente = new UltimoPacienteChamado([
                                'paciente_pk' => $ultimoPacienteChamado[0]->idDoPaciente
                        ]);
                
                        $paciente->save();

                        return view('/novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' => $ultimoPacienteChamado]);             
                 } else {
                        return view('/novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' =>null]);             

                }
        }              
  

  
    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
   
    }  

 }