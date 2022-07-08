<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Paciente;
use App\Model\PacienteDoDia;

class pacientesDoDia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cadastrarPacientesDoDia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserir pacientes do dia de hoje';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pacientesDoDiaDeHoje = [];
        $dia = date('w');


         // Buscando Pacientes do Dia SEG,QUA E SEX = TER,QUI E SAB
        if ($dia == 1 || $dia == 3 || $dia == 5){
            $pacientesDoDiaDeHoje = \DB::table('paciente as pac')->select('pac.id','pac.sala','pac.turno')
                                    -> where ('pac.dias_semana','1')
                                    ->get();
    
        } else {
            $pacientesDoDiaDeHoje = \DB::table('paciente as pac')->select('pac.id','pac.sala','pac.turno')
                                    -> where ('pac.dias_semana','2')
                                    ->get();

        }

        
        foreach ($pacientesDoDiaDeHoje as $key => $value) {
            PacienteDoDia::create([
                'paciente_pk' => $value->id ,
                'chegou' => '1' ,
                'chamado' => '1' ,
                'observacao' => '',
                'sala_do_dia' => $value->sala ,
                'turno_do_dia' => $value->turno ,
            ]);
        }
    
    }
}
