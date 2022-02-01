<?php

namespace App\Http\Controllers;


use App\Model\Paciente;
use Illuminate\Http\Request;


class PrincipalController extends Controller
{

    public function inicio(){
        return view('paginainicial');
    }
    

    public function index ()
    {
        
       /* $pacientesDeHoje = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
        'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado')
  ->where('nome_completo',$)
  ->get();
*/        
        return view('principal');

        //return view('/resultadoconsultapaciente', ['paciente' => $paciente]);


    }

    public function create()
    {
        return view('cadastropaciente');
    }

  
    public function store(Request $request)
    {
        $nomeCompleto= $request-> nomeCompleto;
        $diasDaSemana = $request-> diasDaSemana;
        $turno = $request-> turno;
        $sala  = $request-> sala;

        $paciente = new Paciente([
            'nome_completo' => $nomeCompleto,
            'dias_semana' => $diasDaSemana,
            'turno' => $turno,
            'sala'  => $sala
        ]);


        dd($paciente);
        //$pacientes->save();

        
        //return redirect('pacientes/create');
    }

    
    
    public function show(Request $request)
    {   
        $nome = $request-> nomeCompleto;
        $data = $request-> dataNascimento;
        $paciente = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
                                      'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado')
                                ->where('nome_completo',$nome)
                                ->get();

        return view('/resultadoconsultapaciente', ['paciente' => $paciente]);
                    
                    
    }              
  

  
    public function edit($id)
    {
     
        $paciente = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
                                      'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado','id')
                                 ->where('id',$id)
                                 ->get();
       
        return view('editarpaciente', ['paciente' => $paciente]);
      
    }


    public function update(Request $request, $id)
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

       
        $pac = Pacientes::find($id);
                
        $paciente = $pac->update([
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

        return view('consultarpaciente');
   
    }




    public function resultadoconsulta(Request $request){
              
        $nome = $request-> nomeCompleto;
        $data = $request-> dataNascimento;
        $paciente = Pacientes::select('nome_completo','data_nascimento','convenio_paciente','soro_positivo','status_paciente',
                                      'segunda_feira','terca_feira','quarta_feira','quinta_feira','sexta_feira','sabado','id')
                                ->where('nome_completo',$nome)->where('data_nascimento',$data)
                                ->get();
       
        return view('/resultadoconsultapaciente', ['paciente' => $paciente]);

    }        


   

 }