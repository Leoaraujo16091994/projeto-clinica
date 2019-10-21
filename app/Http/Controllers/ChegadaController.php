<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Chegada;

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

    
   
}


