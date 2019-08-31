<?php

namespace App\Http\Controllers;


use App\Model\Pacientes;
use Illuminate\Http\Request;


class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 return view('consultarpaciente');
        
        
    //    $todosPacientes = $request->all();
     //   return view('resultadoconsultapaciente',compact('todosPacientes'));

        
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastropaciente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        
        $paciente = Pacientes::find($id);
         return view('resultadoconsultapaciente', [ 'paciente' => $paciente]);
          
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