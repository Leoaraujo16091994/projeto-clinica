
@extends ('layout')

@section('titulodoNavegador')
   Painel
@endsection


@section('body')

    <div class="row">
        <div class="col-sm-10" >
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

        @if($qtdPacientes == 0 )
            <table border = "5px">
                <tr>            
                        <td rowspan="3">
                            <h3>Paciente: </h3>
                                {{'Sem pacientes cadastrados'}}
                        </td>    
                    </tr>
                    </table>

        @elseif ($qtdPacientes == 1 ) 
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
                                        {{"Vazio"}}
                                    <h3>Sala:</h3>
                                        {{"Vazio"}}
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td>
                                    <h3>Paciente: </h3>
                                        {{"Vazio"}}
                                    <h3>Sala:</h3>
                                        {{"Vazio"}}  
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>


        @elseif($qtdPacientes == 2 )
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
                                        {{"Vazio"}}
                                    <h3>Sala:</h3>
                                        {{"Vazio"}}  
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
    
    @else
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

   @endif
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

</style>
