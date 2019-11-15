<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Chamada;

class faltaPacientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cadastrarFaltas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserir como falta os pacientes que não foram chamados';

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
        $pacFaltaram = [];
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
           
        // tenho salvar um a um
        foreach ($pacFaltaram as $key => $value) {
            Chamada::create([
                'nome_completo' => $value->nome_completo,
                'sala' => '-',
                'status'=> 'F'
            ]);
        }
    
    }
}
