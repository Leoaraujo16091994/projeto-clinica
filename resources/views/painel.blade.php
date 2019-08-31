
@extends ('layout')

@section('titulodoNavegador')
   Painel
@endsection





@section('body')
<!--
var intervalo = setInterval(function() { $('#id_da_div_para_actualizar').load('caminho/para/ficheiro.php'); }, 1000);
-->
<div class="row">
          <div class="col-sm-10 >
            <div class="form-group">
<div id = "titulopagina">
       <h1> Painel </h1>                
</div>

        <div id = "botaoTelaCheia">
            <form action="/paineltelacheia">
                <button class="btn btn-primary" type= "submit" >tela cheia </button>
        </form>                
        </div>
<br>


<meta http-equiv="refresh" content=10 ; url= "/painel">

    <div class="row">
        <div class="col-sm-1 col-md-100 col-lg-50" >
            <div class= "form-group">

                <table border = "5px">
                    <tr>
                    
                        <td rowspan="3">
                            <h3>Paciente: </h3>
                                {{$paciente[0]->nome_completo}}
                            <h3>Sala:</h3>
                                {{$paciente[0]->sala}}        
                        </td>
                            
                    </tr>

                    <tr>
                        <td>
                            <h3>Paciente: </h3>
                                {{$paciente[1]->nome_completo}}
                            <h3>Sala:</h3>
                                {{$paciente[1]->sala}}
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td>
                            <h3>Paciente: </h3>
                                {{$paciente[2]->nome_completo}}
                            <h3>Sala:</h3>
                                {{$paciente[2]->sala}}  
                        </td>
                    </tr>


                </table>

            </div>
        </div>
    </div>

   

   





@endsection

<style>

table{    
    text-align:center;
    margin-left:15em;
    width:40em;
    height:60%;
}





 table h3{
    color:black;
}

tr td{
    font-family: 'Anton', sans-serif;
    font-size:25px;
    color:#0000FF;
    
}


#botaoTelaCheia{
    margin-left:100%;
    margin-top:-5%;
}
/*
#primeira{
 text-align:center;
 width:41%;
 height:74%;
 margin-left:18.7%;
 margin-top:1%;
 border:2px solid black;
 padding-top:5%;
 
 
}


#segunda{
    position:absolute;
 text-align:center;
 width:41%;
 height:38%;
 margin-left:59.5%;
 margin-top:-48%;
 border:2px solid black;

 
 
}

#terceira{
 text-align:center;
 width:41%;
 height:36.5%;
 margin-left:59.5%;
 margin-top:-0.2%;
 border:2px solid black;
 
 
}


#letraspainel{
    font-family: 'Anton', sans-serif;
    font-size:4rem;
    color:#0000FF;
}


*/

</style>
