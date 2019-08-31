<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Chamada;
use App\Model\Chegada;
use App\Model\Pacientes;

class ChamadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {/*
        date_default_timezone_set('America/Fortaleza');
        $diaSemana = null;
        switch (date('w')) {
            case '0':
                $diaSemana = 'domingo';
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

        $pacientesPresentes = Pacientes::select('id', 'nome_completo')->where($diaSemana, 'on')->get();
        return view ('chamarpaciente',['pacientes'=> $pacientesPresentes]);
        return view ('chamarpaciente');
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('chamarpaciente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nome = $request -> nomeCompleto;
        $sala = $request -> sala;

        $paciente = new Chamada([
            'nome_completo' => $nome,
            'sala' => $sala,
            
            ]);

        $paciente ->save();
        
        return redirect('chamarpainel/create');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   
   
    public function exibirpainel(Request $request)
    {
       // $count = Chamada::all()->count();   
        $paciente = Chamada::select('nome_completo','sala')
                            ->orderByRaw('created_at DESC')
                            ->get();

        return view('/painel',compact('paciente'));
    }

    

    
    public function paineltelacheia()
    {
        //$count = Chamada::all()->count();   
        $paciente = Chamada::select('nome_completo','sala')
                            -> orderByRaw('created_at DESC')
                            ->get();

        return view('/paineltelacheia',compact('paciente'));
    }




}
