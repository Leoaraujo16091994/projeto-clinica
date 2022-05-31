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

                $pacientesDoDia = DB::table('pacientes_do_dia as pacDia1')
                ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                ->select('pacDia1.sala_do_dia', 
                        (DB::raw('(
                                SELECT `pac2`.`id` 
                                        FROM `paciente` AS `pac2` 
                                    INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                `pac2`.`id` = `pacDia2`.`paciente_pk`
                                     WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) idDoPaciente')), 
                        (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                        (DB::raw('(
                                SELECT `pac3`.`nome_completo` 
                                        FROM `paciente` AS `pac3` 
                                INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                        `pac3`.`id` = `pacDia3`.`paciente_pk`
                                WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) nome_completo'))
                        )
                ->where('pacDia1.chamado', '=', '2')
                ->groupBy('pacDia1.sala_do_dia')
                ->get();
               

                $ultimoPacienteChamado = DB::table('pacientes_do_dia as pacDia1')
                ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                ->select('pacDia1.sala_do_dia', 
                        (DB::raw('(
                                SELECT `pac2`.`id` 
                                        FROM `paciente` AS `pac2` 
                                        INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                `pac2`.`id` = `pacDia2`.`paciente_pk`
                                        WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) idDoPaciente')), 
                        (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                        (DB::raw('(
                                SELECT `pac3`.`nome_completo` 
                                        FROM `paciente` AS `pac3` 
                                INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                        `pac3`.`id` = `pacDia3`.`paciente_pk`
                                WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) nome_completo'))
                        )
                ->where('pacDia1.chamado', '=', '2')
                ->groupBy('pacDia1.sala_do_dia')
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
                
                $pacientesDoDia = DB::table('pacientes_do_dia as pacDia1')
                        ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                        ->select('pacDia1.sala_do_dia', 
                                (DB::raw('(
                                        SELECT `pac2`.`id` 
                                                FROM `paciente` AS `pac2` 
                                            INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                        `pac2`.`id` = `pacDia2`.`paciente_pk`
                                             WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) idDoPaciente')), 
                                (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                                (DB::raw('(
                                        SELECT `pac3`.`nome_completo` 
                                                FROM `paciente` AS `pac3` 
                                        INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                                `pac3`.`id` = `pacDia3`.`paciente_pk`
                                        WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) nome_completo'))
                                )
                        ->where('pacDia1.chamado', '=', '2')
                        ->groupBy('pacDia1.sala_do_dia')
                        ->get();
                        
                        
                $ultimoPacienteChamado = DB::table('pacientes_do_dia as pacDia1')
                                ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                                ->select('pacDia1.sala_do_dia', 
                                        (DB::raw('(
                                                SELECT `pac2`.`id` 
                                                        FROM `paciente` AS `pac2` 
                                                INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                                `pac2`.`id` = `pacDia2`.`paciente_pk`
                                                WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) idDoPaciente')), 
                                        (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                                        (DB::raw('(
                                                SELECT `pac3`.`nome_completo` 
                                                        FROM `paciente` AS `pac3` 
                                                INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                                        `pac3`.`id` = `pacDia3`.`paciente_pk`
                                                WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`) ) nome_completo'))
                                        )
                                ->where('pacDia1.chamado', '=', '2')
                                ->groupBy('pacDia1.sala_do_dia')
                        ->orderByDesc('ultimoAtualizado')
                        ->limit(1)
                        ->get();
                        
                
                
                $ultimoPacienteChamadoSalvo= DB::table('ultimo_paciente_chamado')
                        ->select('ultimo_paciente_chamado.paciente_pk')
                        ->orderByDesc('ultimo_paciente_chamado.updated_at')
                        ->limit(1)
                        ->get();


                        //dd(count($ultimoPacienteChamado)> 0); // FALSE
                        //dd(count($ultimoPacienteChamadoSalvo)> 0); // FALSE


/*
if(count($ultimoPacienteChamado) > 0){
        if(count($ultimoPacienteChamadoSalvo) ===0){
                $paciente = new UltimoPacienteChamado([
                        'paciente_pk' => $ultimoPacienteChamado[0]->idDoPaciente
                ]);
        
                $paciente->save();

                return view('/novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' => $ultimoPacienteChamado]);             
        
        } else if($ultimoPacienteChamado[0]->idDoPaciente != $ultimoPacienteChamadoSalvo[0]->paciente_pk ){
                $paciente = new UltimoPacienteChamado([
                        'paciente_pk' => $ultimoPacienteChamado[0]->idDoPaciente
                ]);
        
                $paciente->save();

                return view('/novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' => $ultimoPacienteChamado]);             
        }   


}else {
        return view('/novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' =>null]);

}

  */

//dd(count($ultimoPacienteChamado) > 0 ); // TRUE
//dd(count($ultimoPacienteChamadoSalvo) === 0); // FALSE ,pois ja existe
//dd($ultimoPacienteChamado[0]->idDoPaciente != $ultimoPacienteChamadoSalvo[0]->paciente_pk);


        if(count($ultimoPacienteChamado) > 0 ){
                if(count($ultimoPacienteChamadoSalvo) === 0 || $ultimoPacienteChamado[0]->idDoPaciente != $ultimoPacienteChamadoSalvo[0]->paciente_pk){
                        $paciente = new UltimoPacienteChamado([
                                'paciente_pk' => $ultimoPacienteChamado[0]->idDoPaciente
                        ]);
                        
                                $paciente->save();
                        return view('/novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' => $ultimoPacienteChamado]);             
                }  else {
                
                        return view('/novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' =>null]);             
                }                     
                
        }      else {
                return view('/novoPainelTelaCheia',['pacientesDoDia' => null],['ultimoPacienteChamado' =>null]); 
        }    
}

        
        public function edit($id)
        {

        }


        public function update(Request $request, $id)
        {
        
        }  

 }