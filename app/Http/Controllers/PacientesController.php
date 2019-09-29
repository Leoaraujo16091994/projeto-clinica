<?php

namespace App\Http\Controllers;


use App\Model\Pacientes;
use Illuminate\Http\Request;


class PacientesController extends Controller
{
    

    public function create()
    {
        return view('cadastropaciente');
    }

  
    public function store(Request $request)
    {
        $nome = $request-> nomeCompleto;
        $data = $request-> dataNascimento;
        $convenio = $request-> convenio;
        $tsanguineo = $request-> tpSanguineo;
        $status = $request-> status;
        $segunda = $request-> segundaFeira;
        $terca = $request-> tercaFeira;
        $quarta = $request-> quartaFeira;
        $quinta = $request-> quintaFeira;
        $sexta = $request-> sextaFeira;
        $sabado = $request-> sabado;


        $pacientes = new Pacientes([
            'nome_completo' => $nome,
            'data_nascimento' => $data,
            'convenio_paciente' => $convenio,
            'soro_positivo' =>  $tsanguineo,
            'status_paciente' => $status,
            'segunda_feira'=>  $segunda,
            'terca_feira' =>  $terca,
            'quarta_feira' =>  $quarta,
            'quinta_feira' =>  $quinta,
            'sexta_feira'  =>  $sexta,
            'sabado' =>    $sabado,
            'convenio_paciente'=>    $convenio ,
            'soro_positivo' => $tsanguineo,
        ]);

        $pacientes->save();

        
        return redirect('pacientes/create');
    }


    public function show($id)
    {      
        
        $paciente = Pacientes::find($id);
         return view('resultadoconsultapaciente', [ 'paciente' => $paciente]);
          
    }        
  
  
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    
    
    
    
    public function consultar(){
        return view('consultarpaciente');
    }


    public function resultadoconsulta(Request $request){
              
        $nome = $request-> nomeCompleto;
        $data = $request-> dataNascimento;
        $paciente = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
                                      'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado')
                    ->where('nome_completo',$nome)->where('data_nascimento',$data)
                    ->get();
       
        return view('/resultadoconsultapaciente', ['paciente' => $paciente]);
       
    }        
   


    public function inicio(){
        return view('paginainicial');
    }
    
    
    
   
    
 }