<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use App\Model\Paciente;
use App\Model\PacienteDoDia;
use App\Model\UltimoPacienteChamado;
use Illuminate\Http\Request;


class PainelController extends Controller
{

        public function index()
        {
                $textoAcompanhante = "'ACOMPANHANTE '";
                $pacientesDoDia = DB::table('pacientes_do_dia as pacDia1')
                        ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                        ->select(
                                'pacDia1.sala_do_dia',
                                (DB::raw('
                                                (
                                                        SELECT `pac2`.`id` 
                                                        FROM `paciente` AS `pac2` 
                                                        INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                                `pac2`.`id` = `pacDia2`.`paciente_pk`
                                                        WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) 
                                                        AND date(`pacDia2`.`created_at`) = (SELECT CURDATE())
                                                ) idDoPaciente')),
                                (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                                (DB::raw('
                                                (
                                                        SELECT 
                                                        CASE 
                                                        WHEN `pacDia3`.`chamar_acompanhante` IS NOT NULL THEN concat(' . $textoAcompanhante . ', `pac3`.`nome_completo`)
                                                                ELSE `pac3`.`nome_completo` 
                                                                END AS nome_completo
                                                        FROM `paciente` AS `pac3` 
                                                        INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                                                `pac3`.`id` = `pacDia3`.`paciente_pk`
                                                        WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`) 
                                                        AND date(`pacDia3`.`created_at`) = (SELECT CURDATE())
                                                ) nome_completo'))
                        )
                        ->where('pacDia1.chamado', '=', '2')
                        ->whereDate('pacDia1.created_at', today())
                        ->groupBy('pacDia1.sala_do_dia')
                        ->get();



                $ultimoPacienteChamado = DB::table('pacientes_do_dia as pacDia1')
                        ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                        ->select(
                                'pacDia1.sala_do_dia',
                                (DB::raw('
                                                        (
                                                                SELECT `pac2`.`id` 
                                                                FROM `paciente` AS `pac2` 
                                                                INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                                        `pac2`.`id` = `pacDia2`.`paciente_pk`
                                                                WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) 
                                                                AND date(`pacDia2`.`created_at`) = (SELECT CURDATE())
                                                        ) idDoPaciente')
                                ),
                                (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                                (DB::raw(
                                        '
                                                        (
                                                                SELECT `pac3`.`nome_completo` 
                                                                FROM `paciente` AS `pac3` 
                                                                INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                                                        `pac3`.`id` = `pacDia3`.`paciente_pk`
                                                                WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`) 
                                                                AND date(`pacDia3`.`created_at`) = (SELECT CURDATE())
                                                        ) nome_completo'
                                )
                                )
                        )
                        ->where('pacDia1.chamado', '=', '2')
                        ->whereDate('pacDia1.created_at', today())
                        ->groupBy('pacDia1.sala_do_dia')
                        ->orderByDesc('ultimoAtualizado')
                        ->limit(1)
                        ->get();


                $ultimoPacienteChamadoSalvo = DB::table('ultimo_paciente_chamado')
                        ->select('ultimo_paciente_chamado.paciente_pk')
                        ->orderByDesc('ultimo_paciente_chamado.updated_at')
                        ->limit(1)
                        ->get();



                if (count($ultimoPacienteChamado) > 0) {
                        if (count($ultimoPacienteChamadoSalvo) === 0 || $ultimoPacienteChamado[0]->idDoPaciente != $ultimoPacienteChamadoSalvo[0]->paciente_pk) {
                                $paciente = new UltimoPacienteChamado([
                                        'paciente_pk' => $ultimoPacienteChamado[0]->idDoPaciente
                                ]);
                                $paciente->save();

                                return view('/painel.novoPainel', ['pacientesDoDia' => $pacientesDoDia], ['ultimoPacienteChamado' => $ultimoPacienteChamado]);
                        } else {

                                return view('/painel.novoPainel', ['pacientesDoDia' => $pacientesDoDia], ['ultimoPacienteChamado' => null]);
                        }
                } else {
                        return view('/painel.novoPainel', ['pacientesDoDia' => null], ['ultimoPacienteChamado' => null]);
                }
        }



        public function show()
        {
                $textoAcompanhante = "'ACOMPANHANTE '";

                $ultimoPacienteChamado =  DB::table('pacientes_do_dia as pacDia')
                        ->select('pacDia.id', 'pacDia.sala_do_dia', 'pac.nome_completo')
                        ->join('paciente as pac', 'pacDia.paciente_pk', '=', 'pac.id')
                        ->where('pacDia.chamado', '=', '2')
                        ->where('pacDia.chamado_painel', '=', '1')
                        ->whereDate('pacDia.created_at', today())
                        ->orderBy('pacDia.updated_at', 'ASC')
                        ->limit(1)
                        ->get();

                if ($ultimoPacienteChamado->isNotEmpty()) {

                        $pac = PacienteDoDia::where('id', '=', $ultimoPacienteChamado[0]->id);

                        $paciente = $pac->update([
                                'chamado_painel' => 2
                        ]);
                }

                $pacientesDoDia = DB::table('pacientes_do_dia as pacDia')
                        ->select('pac.id', 'pacDia.sala_do_dia','pac.nome_completo')
                        ->join('paciente as pac', 'pacDia.paciente_pk', '=', 'pac.id')
                        ->where('pacDia.chamado', '=', '2')
                        ->where('pacDia.chamado_painel', '=', '2')
                        ->whereDate('pacDia.created_at', today())
                        ->groupBy('pacDia.sala_do_dia')
                        ->toSql();
                        //->get();

dd($pacientesDoDia);
               
select 
	 `pacDia`.`sala_do_dia`, 
     `pac`.`nome_completo` 
from `pacientes_do_dia` as `pacDia` 
 inner join `paciente` as `pac` on 
	`pacDia`.`paciente_pk` = `pac`.`id` 
where `pacDia`.`chamado` = 2 
and `pacDia`.`chamado_painel` = 2 
and date(`pacDia`.`created_at`) = '2023-07-31' 
group by  `pacDia`.`sala_do_dia`, `pac`.`nome_completo` 
                if ($ultimoPacienteChamado->isNotEmpty()) {
                        return view(
                                '/painel.novoPainelTelaCheia',
                                ['pacientesDoDia' => $pacientesDoDia],
                                ['ultimoPacienteChamado' => $ultimoPacienteChamado]
                        );
                } else {
                        return view('/painel.novoPainelTelaCheia', ['pacientesDoDia' => $pacientesDoDia], ['ultimoPacienteChamado' => null]);
                }
               /* if ($pacientesDoDia->isEmpty()) {
                        return view('/painel.novoPainelTelaCheia', ['pacientesDoDia' => null], ['ultimoPacienteChamado' => null]);
                }*/






                /* 
                $pacientesDoDia = DB::table('pacientes_do_dia as pacDia1')
                        ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                        ->select('pacDia1.sala_do_dia', 
                                (DB::raw('
                                                (
                                                        SELECT `pac2`.`id` 
                                                                FROM `paciente` AS `pac2` 
                                                        INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                                        `pac2`.`id` = `pacDia2`.`paciente_pk`
                                                        WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) 
                                                        AND date(`pacDia2`.`created_at`) = (SELECT CURDATE())
                                                ) idDoPaciente'
                                        )
                                ), 
                                (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                                (DB::raw('
                                                (
                                                        SELECT CASE 
                                                        WHEN `pacDia3`.`chamar_acompanhante` IS NOT NULL THEN concat('.$textoAcompanhante. ', `pac3`.`nome_completo`)
                                                                ELSE `pac3`.`nome_completo` 
                                                                END AS nome_completo
                                                                FROM `paciente` AS `pac3` 
                                                        INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                                                `pac3`.`id` = `pacDia3`.`paciente_pk`
                                                        WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`)
                                                        AND date(`pacDia3`.`created_at`) = (SELECT CURDATE())
                                                ) nome_completo'
                                        )
                                )
                        )
                        ->where('pacDia1.chamado', '=', '2')
                        ->whereDate('pacDia1.created_at',today())
                        ->groupBy('pacDia1.sala_do_dia')
                        ->get();
                        

                    
                     
                $ultimoPacienteChamado = DB::table('pacientes_do_dia as pacDia1')
                                ->join('paciente as pac1', 'pacDia1.paciente_pk', '=', 'pac1.id')
                                ->select('pacDia1.sala_do_dia', 
                                        (DB::raw('
                                                (
                                                        SELECT `pac2`.`id` 
                                                                FROM `paciente` AS `pac2` 
                                                        INNER JOIN `pacientes_do_dia` as `pacDia2` ON 
                                                                        `pac2`.`id` = `pacDia2`.`paciente_pk`
                                                        WHERE `pacDia2`.`updated_at` = MAX(`pacDia1`.`updated_at`) 
                                                        AND date(`pacDia2`.`created_at`) = (SELECT CURDATE())
                                                ) idDoPaciente'
                                                )
                                        ), 
                                        (DB::raw('MAX(pacDia1.updated_at) ultimoAtualizado')),
                                        (DB::raw('
                                                (
                                                        SELECT CASE 
                                                        WHEN `pacDia3`.`chamar_acompanhante` IS NOT NULL THEN concat('.$textoAcompanhante. ', `pac3`.`nome_completo`)
                                                                ELSE `pac3`.`nome_completo` 
                                                                END AS nome_completo 
                                                                FROM `paciente` AS `pac3` 
                                                        INNER JOIN `pacientes_do_dia` as `pacDia3` ON 
                                                                `pac3`.`id` = `pacDia3`.`paciente_pk`
                                                        WHERE `pacDia3`.`updated_at` = MAX(`pacDia1`.`updated_at`) 
                                                        AND date(`pacDia3`.`created_at`) = (SELECT CURDATE())
                                                ) nome_completo'
                                                )
                                        )
                                )
                                ->where('pacDia1.chamado', '=', '2')
                                ->whereDate('pacDia1.created_at',today())
                                ->groupBy('pacDia1.sala_do_dia')
                        ->orderByDesc('ultimoAtualizado')
                        ->limit(1)
                        ->get();
                        
                
                
                $ultimoPacienteChamadoSalvo= DB::table('ultimo_paciente_chamado')
                        ->select('ultimo_paciente_chamado.paciente_pk')
                        ->orderByDesc('ultimo_paciente_chamado.updated_at')
                        ->limit(1)
                        ->get();


                       
                if(count($ultimoPacienteChamado) > 0 ){
                        if(count($ultimoPacienteChamadoSalvo) === 0 || $ultimoPacienteChamado[0]->idDoPaciente != $ultimoPacienteChamadoSalvo[0]->paciente_pk){
                                $paciente = new UltimoPacienteChamado([
                                        'paciente_pk' => $ultimoPacienteChamado[0]->idDoPaciente
                                ]);
                                
                                        $paciente->save();
                                return view('/painel.novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' => $ultimoPacienteChamado]);             
                        }  else {
                        
                                return view('/painel.novoPainelTelaCheia',['pacientesDoDia' => $pacientesDoDia],['ultimoPacienteChamado' =>null]);             
                        }                     
                        
                }      else {
                        return view('/painel.novoPainelTelaCheia',['pacientesDoDia' => null],['ultimoPacienteChamado' =>null]); 
                }    */
        }
}
