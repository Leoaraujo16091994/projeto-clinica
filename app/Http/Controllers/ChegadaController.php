<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Chegada;
use App\Model\Pacientes;

use DB;

class ChegadaController extends Controller
{

    public function create()
    {
        return view('informarchegada');
    }


    public function store(Request $request)
    {
        $nome= $request -> nomeCompleto;
        $paciente = new Chegada([
            'nome_completo' => $nome,
        ]);

        $paciente ->save();

        return redirect('chegada/create');
    }

    
    
    public function show()
    {
        $pacientesPresentes = Chegada::all();
        echo $pacientesPresentes;
    }


     public function fetch(Request $request)
     {
      if($request->get('query'))
      {
        $query = $request->get('query');
        $data = Pacientes::select('nome_completo')
                        ->where('nome_completo', 'LIKE', "%{$query}%")->limit(3)
                        ->get();
        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        { 
            $output .= '<li><a href="#">'.$row->nome_completo.'</a></li>';
        }
        $output .= '</ul>';
        echo $output;
        }
        }

     




    }



