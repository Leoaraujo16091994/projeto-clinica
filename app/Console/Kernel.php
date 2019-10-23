<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Comands/faltaPacientes::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {     $schedule->command('faltaPacientes')
                  //->dailyAt('21:00');
                  ->everyMinute();
                
                  
/*
    $schedule->call(function (){
        DB::table('pacientes as pac')->select('pac.nome_completo')
        -> whereRaw("NOT EXISTS (select 1 from chamada as chamada where chamada.nome_completo = c.nome_completo and date(chamada.created_at) = '".date('Y-m-d')."')")
        -> whereRaw("date(c.created_at) = '".date('Y-m-d')."'")
        -> get();
                   
        })
*/



        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
