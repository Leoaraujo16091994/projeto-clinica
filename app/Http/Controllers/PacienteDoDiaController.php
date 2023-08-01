<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use App\Model\Paciente;
use App\Model\PacienteDoDia;
use App\Model\UltimoPacienteChamado;
use Illuminate\Http\Request;
use App\Http\Controllers\PainelController;

class PacienteDoDiaController extends Controller
{

    public function index (Request $request)
    {   
        $pacientesDoDia= PacienteDoDia::getBuscarPacientesDoDia($request);
        return view('pacienteDoDia.index', ['pacientesDoDia' => $pacientesDoDia],['requisicao' => $request]);
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

        $paciente->save();
   
        return redirect('/pacienteDoDia');
    }

//Exibir a lista de todos pacientes no cadastro de paciente extra
    public function todosPacientes()
    {
        $todosPaciente = Paciente::orderBy('nome_completo','ASC')->get();
        
        $output = '<select>';
        
        foreach($todosPaciente as $paciente)
        { 
            $output .= '<option value =' .$paciente->id.' >'.$paciente->nome_completo.'</option>';
        }
        $output .= '</select>';
       
        echo $output;
    }
        


    public function storePacienteExtra(Request $request)
    {
        $idPacienteExtra = $request-> paciente;
        $salaDoPaciente = $request -> salaPacienteExtra;
        $turnoDoPaciente = $request -> turnoPacienteExtra;

        $pacienteJaCadastrado = DB::table('pacientes_do_dia')
        ->whereDate('pacientes_do_dia.created_at', date('Y-m-d'))
        ->where('pacientes_do_dia.paciente_pk',$idPacienteExtra)->exists();
        
        
        if(!$pacienteJaCadastrado){

            $paciente = new PacienteDoDia([
                'paciente_pk' => $idPacienteExtra,
                'chegou' => 1,
                'chamado' => 1,
                'sala_do_dia' => $salaDoPaciente,
                'turno_do_dia' => $turnoDoPaciente
            ]);

            $paciente->save();
            
            return redirect('/pacienteDoDia');
        } else {
           return redirect()->back()->withErrors(['name']);
        
        }

    }
    
    public function show($id)
    {  
        
        $paciente = DB::table('paciente')
                    ->join('pacientes_do_dia', 'pacientes_do_dia.paciente_pk', '=', 'paciente.id')
                    ->select('paciente.*','pacientes_do_dia.*')
                    ->where('pacientes_do_dia.id',$id)->get();
   
        return view('pacienteDoDia.edit',['pacienteSelecionado' => $paciente]); 
    }              
  

    public function update(Request $request, $id)
    {
        $observacao = $request->observacao;
     
        $pac = PacienteDoDia::find($id);
       
        $pacienteChegou = $request -> chegadaPaciente;
        $pacienteChamado = $request -> chamadaPaciente;

        $pacienteAlterado = $request -> pacienteAlterado;

        if($pacienteChegou){
            $paciente = $pac->update([
                'observacao' => $observacao,
                'chegou' => 2
            ]);
        }

        if($pacienteChamado){
            $paciente = $pac->update([
                'chamado' => 2
            ]);
        }


        if($pacienteAlterado){

            $paciente = $pac->update([
                'chegou' => $request->chegou,
                'chamado' => $request->chamado,
                'observacao' => $request->observacao,
                'sala_do_dia' => $request->sala_do_dia,
                'turno_do_dia' => $request->turno_do_dia,
            ]);

        }
       
       return redirect('/pacienteDoDia');
    }




    function chamarNovamente($id){
        
        $pac = PacienteDoDia::where('paciente_pk','=',$id);

        $paciente = $pac->update([
            'chamado' => 2,
            'chamado_painel' => 1
        ]);
        
        $pac = UltimoPacienteChamado::where('paciente_pk','=',$id);
        $pac->delete();
        return back()->withInput();
    }

    
    
    function chamarAcompanhante($id){
        
        $pac = PacienteDoDia::where('paciente_pk','=',$id);

        $paciente = $pac->update([
            'chamar_acompanhante' => 2,
            'chamado_painel' => 1
        ]);


        $pac = UltimoPacienteChamado::where('paciente_pk','=',$id);
        $pac->delete();
        return back()->withInput();
    }


    public function destroy(Request $request){
        $pacienteDoDiaExcluido = PacienteDoDia::find($request->idPacienteExcluido);
         $pacienteDoDiaExcluido->delete();
        return back()->withInput();
    }
  
}