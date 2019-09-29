@extends ('layout')

@section('titulodoNavegador')
   Resultado - Consulta de Paciente
@endsection


@section('body')


<div id = "titulopagina">
       <h1> Resultado - Consulta de Paciente </h1>                
</div>
<br>


<div class='resultado'>

@if(count($paciente) == 0)
        <h3> Não Foi encontrado Ninguem </h3>
        <div id ="segundoBotaoVoltar">
            <form action = "consultarpaciente">
                <button class="btn btn-info btn-lg" >   Voltar	</button>
            <form>
        </div>
@else

@foreach($paciente as $pac)
    
        <label> Nome Completo </label>
            <div id = "campoResultado">
                {{$pac->nome_completo}}
            </div>
        <br>

        <label > Data de Nascimento </label>
            <div id = "campoResultado">
                {{ \Carbon\Carbon::parse($pac->data_nascimento)->format('d/m/Y')}}
            </div>
        <br>
       
        <label > Convênio do Paciente </label>
            <div id = "campoResultado">
                {{$pac->convenio_paciente}}
            </div>
        <br>

        <label > Paciente é Soro Positivo ? </label>
            <div id = "campoResultado">
                {{$pac->soro_positivo}}
            </div>
        <br>
</div>

        <div class="resultado">    
            <div class="dias">
                <label>  Dias da Semana </label>  <br>
                @if( $pac->segunda_feira && $pac->quarta_feira && $pac->sexta_feira == "on")
                    <input type="checkbox" checked> Segunda Feira  <br>
                    <input type="checkbox" > Terça Feira           <br>
                    <input type="checkbox" checked> Quarta Feira   <br>
                    <input type="checkbox" > Quinta Feira          <br>
                    <input type="checkbox" checked> Sexta Feira    <br>
                    <input type="checkbox" > Sábado                <br>
                
                @else
                    <input type="checkbox" > Segunda Feira          <br>
                    <input type="checkbox" checked> Terça Feira     <br>
                    <input type="checkbox" > Quarta Feira           <br>
                    <input type="checkbox" checked > Quinta Feira   <br>
                    <input type="checkbox" > Sexta Feira            <br>
                    <input type="checkbox" checked> Sábado          <br>
                
                @endif
            </div>

        </div>


        <div class="resultado">    
            <div class="status">
                <label>  Status Do Paciente  </label>   <br>
                @if($pac->status_paciente == "Em Tratamento")
                    <select>
                        <option  selected >Em Tratamento </option>
                    </select>
                @elseif ($pac->status_paciente == "Obito")
                    <select>
                        <option  selected >Obito </option>
                    </select>

                @elseif ($pac->status_paciente == "Trânsito")
                <select>
                        <option  selected >Trânsito </option>
                    </select>

                @elseif ($pac->status_paciente == "Abandono")
                    <select>
                        <option  selected >Abandono</option>
                    </select>

                @elseif ($pac->status_paciente == "Transferido")
                    <select>
                        <option  selected >Transferido </option>
                    </select>

                @elseif ($pac->status_paciente == "Internado")
                    <select>
                        <option  selected >Internado</option>
                    </select>

                @else($pac->status_paciente == "Recuperou Função ")
                    <select>
                        <option  selected >Recuperou Função </option>
                    </select>

                @endif
            

        <div id ="botaovoltar">
            <form action = "consultarpaciente">
                <button class="btn btn-info btn-lg" >   Voltar	</button>
            <form>
        </div>
        
        <div id ="botaoEditar">
            <form action = "">
                <button class="btn btn-info btn-lg" >   Voltar	</button>
            <form>
        </div>
        



       
           </div>
    </div>

@endforeach
@endif

   




@endsection

    <style>

    .resultado{        
       font-size:120%;
    }


    .resultado .dias{
        margin-top:-30.5rem;
        margin-left:40rem;
    }

    .resultado .status{
        margin-top:-17rem;
        margin-left:60rem;
    }
    

    #campoResultado{
        width:350px;
        border-style: solid;
        border-width:1px;
        text-align:center;
        background-color:#ffffff;
    }
   
   #botaoVoltar{
        margin-left: -60rem;
        margin-top:25rem;
   }

    #segundoBotaoVoltar{
        margin-left: 2rem;
        margin-top:25rem;

}
    
    </style>
