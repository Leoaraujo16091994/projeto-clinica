<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pacientes;
use App\Model\Chamada;

class RelatoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('relatorio');
    }


    public function relatorio(Request $request)
    {

        $dataInicial = $request-> dataInicial;
        $dataFinal = $request-> dataFinal;
      

        $resultado = [];
        foreach (Pacientes::all() as $key => $paciente) {
            $datasChamadas = Chamada::select('created_at')
                                    ->where('nome_completo',$paciente->nome_completo)
                                    ->whereBetween('created_at',array($dataInicial, $dataFinal))
                                    ->groupBy('created_at')
                                    ->orderBy('created_at')
                                    ->get();


            $status = Chamada::select('status')
                                ->where('nome_completo',$paciente->nome_completo)
                                ->whereBetween('created_at',array($dataInicial, $dataFinal))
                                ->groupBy('created_at')
                                ->orderBy('created_at')
                                ->get();

            $sangue = $paciente->soro_positivo;
                

            for($i = 1 ; $i <= cal_days_in_month(CAL_GREGORIAN, 9,2019);$i++) {
                if ($i) {

                }
            }
        
            if(count($datasChamadas) > 0 ){
                array_push($resultado, [
                    'nome_paciente' => $paciente->nome_completo,
                    'datas' => $datasChamadas,
                    'status' => $status,
                    'sp' => $sangue
                    ]);

            }
        }
      

        $mes = date('m');
        $ano = date('Y');

        return view ('/relatorioPronto',['pacientes'=> $resultado],compact('mes','ano'));

    }

}