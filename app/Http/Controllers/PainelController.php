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

                $ultimoPacienteChamado =  DB::table('pacientes_do_dia as pacDia')
                        ->select(DB::raw('`pacDia`.`id`,`pacDia`.`sala_do_dia`, 
                                        CASE
                                        WHEN `pacDia`.`chamar_acompanhante` IS NOT NULL THEN concat('.$textoAcompanhante. ', `pac`.`nome_completo`)
                                        ELSE `pac`.`nome_completo` 
                                        END AS nome_completo'))
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

                $pacientesDoDia = DB::select( 
                        DB::raw('SELECT 
                                        `sala_do_dia`, 
                                        CASE
                                        WHEN `pacDia`.`chamar_acompanhante` IS NOT NULL THEN concat('.$textoAcompanhante. ', `pac`.`nome_completo`)
                                        ELSE `pac`.`nome_completo` 
                                        END AS nome_completo 
                                FROM `pacientes_do_dia` AS `pacDia` 
                                INNER JOIN `paciente` AS `pac` ON 
                                        `pacDia`.`paciente_pk` = `pac`.`id` 
                                WHERE `pacDia`.`updated_at` IN ( 
                                                                SELECT   
                                                                        max(pacDia1.updated_at)
                                                                FROM `pacientes_do_dia` AS `pacDia1` 
                                                                INNER JOIN `paciente` AS `pac1` ON 
                                                                        `pacDia1`.`paciente_pk` = `pac1`.`id` 
                                                                WHERE `pacDia1`.`chamado` = 2 
                                                                AND `pacDia1`.`chamado_painel` = 2 
                                                                AND DATE(`pacDia1`.`created_at`) = (SELECT CURDATE())
                                                                GROUP BY  `pacDia1`.`sala_do_dia`
                                                                )
                                AND `pacDia`.`chamado` = 2 
                                AND `pacDia`.`chamado_painel` = 2       
                                GROUP BY `sala_do_dia`, `nome_completo`' 
                                )
                                );
                               


                if ($ultimoPacienteChamado->isNotEmpty()) {
                        return view(
                                '/painel.novoPainel',
                                ['pacientesDoDia' => $pacientesDoDia],
                                ['ultimoPacienteChamado' => $ultimoPacienteChamado]
                        );
                } else {
                        return view('/painel.novoPainel', ['pacientesDoDia' => $pacientesDoDia], ['ultimoPacienteChamado' => null]);
                }
               if ($pacientesDoDia->isEmpty()) {
                        return view('/painel.novoPainel', ['pacientesDoDia' => null], ['ultimoPacienteChamado' => null]);
                }

        }



        public function show()
        {
                $textoAcompanhante = "'ACOMPANHANTE '";

                $ultimoPacienteChamado =  DB::table('pacientes_do_dia as pacDia')
                        ->select(DB::raw('`pacDia`.`id`,`pacDia`.`sala_do_dia`, 
                                        CASE
                                        WHEN `pacDia`.`chamar_acompanhante` IS NOT NULL THEN concat('.$textoAcompanhante. ', `pac`.`nome_completo`)
                                        ELSE `pac`.`nome_completo` 
                                        END AS nome_completo'))
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

                $pacientesDoDia = DB::select( 
                        DB::raw('SELECT 
                                        `sala_do_dia`, 
                                        CASE
                                        WHEN `pacDia`.`chamar_acompanhante` IS NOT NULL THEN concat('.$textoAcompanhante. ', `pac`.`nome_completo`)
                                        ELSE `pac`.`nome_completo` 
                                        END AS nome_completo 
                                FROM `pacientes_do_dia` AS `pacDia` 
                                INNER JOIN `paciente` AS `pac` ON 
                                        `pacDia`.`paciente_pk` = `pac`.`id` 
                                WHERE `pacDia`.`updated_at` IN ( 
                                                                SELECT   
                                                                        max(pacDia1.updated_at)
                                                                FROM `pacientes_do_dia` AS `pacDia1` 
                                                                INNER JOIN `paciente` AS `pac1` ON 
                                                                        `pacDia1`.`paciente_pk` = `pac1`.`id` 
                                                                WHERE `pacDia1`.`chamado` = 2 
                                                                AND `pacDia1`.`chamado_painel` = 2 
                                                                AND DATE(`pacDia1`.`created_at`) = (SELECT CURDATE())
                                                                GROUP BY  `pacDia1`.`sala_do_dia`
                                                                )  
                                AND `pacDia`.`chamado` = 2 
                                AND `pacDia`.`chamado_painel` = 2     
                                GROUP BY `sala_do_dia`, `nome_completo`' 
                                )
                                );
                               

                if ($ultimoPacienteChamado->isNotEmpty()) {
                        return view(
                                '/painel.novoPainelTelaCheia',
                                ['pacientesDoDia' => $pacientesDoDia],
                                ['ultimoPacienteChamado' => $ultimoPacienteChamado]
                        );
                } else {
                        return view('/painel.novoPainelTelaCheia', ['pacientesDoDia' => $pacientesDoDia], ['ultimoPacienteChamado' => null]);
                }
        
                if ($pacientesDoDia->isEmpty()) {
                        return view('/painel.novoPainelTelaCheia', ['pacientesDoDia' => null], ['ultimoPacienteChamado' => null]);
                }
        }
}
