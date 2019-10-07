@extends ('layout')

@section('titulodoNavegador')
    Consultar Paciente
@endsection




@section('body')

<script>
   function validar() {

var nome = formulario.nomeCompleto.value;
var dataNascimento = formulario.dataNascimento.value;

if(nome ==""){
    alert("Informe o Nome Completo");
    return 0;
} else if(dataNascimento == ""){
    alert("Informe a Data de Nascimento");
    return 0;
} else {
    
    document.formulario.submit();
    return true;
}}


</script>


<div id = "titulopagina">
       <h1> Consultar Paciente </h1>                
</div>


    <div id="dados">
       <form method = 'get' action='/resultadopaciente' name ="formulario"> 
            @csrf


            <label for="validationnomeCompleto"> Nome Completo </label>
            <input type="text" class="form-control" placeholder="Nome Completo" id="nomeCompleto"  name = "nomeCompleto" ><br>

            <label for="validationdataNascimento">Data de Nascimento </label>
            <input	type="date" class="form-control" placeholder=" Data" id="dataNascimento" name ="dataNascimento" >

            <br> <br>


            <div id="botaoConcluir">
                <button type = "button" class="btn btn-primary btn-lg" alt="botaoConcluir " onclick="validar()" >  Pesquisar </button>
           </div>           
        </form>

    
        <div id="botaoCancelar">
            <form action = "/paginainicial">
                <button class="btn btn-info btn-lg" alt="botaoCancelar"> Cancelar	</button>
            </form>        
        </div>

    
    </div>


@endsection

<style>
    
     #botaoCancelar{
        margin-top:-6.5rem;
        margin-left:15%;
    }
    #dados{
        margin-top:2%;
        margin-left:3%;
    }

    #nomeCompleto {
        height: 5%;
        width: 50%;

    }
    #dataNascimento{
        height:7%;
        width:16%;
    }


</style>




