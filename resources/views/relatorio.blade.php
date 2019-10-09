@extends('layout')


@section('titulodoNavegador')
    Relatório
@endsection


@section('body')


<script>
function validar(){
    var nome = formulario.nomeCompleto.value;

    if(nome == ""){
        alert("Você Deve Informar Um Nome");
    } else {
        alert("Informada");
        document.formulario.submit();
        return true;

    }

}
</script>

    <div id = "titulopagina">
        <h1> Relatório </h1>              
    </div>

        <br>  

    <div id="dados">
        <form method='get' action ='/relatoriospronto' name="formulario">
            @csrf

            <label for="validationdataNascimento"> De </label>
                <input type="date" class="form-control" id="dataInicial" name ="dataInicial"  >


            <label for="validationdataNascimento"> Até </label>
                <input type="date" class="form-control"  id="dataFinal" name ="dataFinal"  >
        </div>

            <br><br><br>
       
         
              
        <div class="row">
          <div class="col-sm-9 col-md-15 col-lg-30">
            <div id="botaoConcluir">
                <button type="submit" class="btn btn-primary btn-lg" alt="botaoConcluir">  Concluir </button> 
            </div>
            </div>
            </div>           
        </form>   

        <div class="row">
          <div class="col-sm-9">
    <div id="botaoCancelar">
        <form action = "/paginainicial">
            <button type="submit" class="btn btn-info btn-lg" alt="botaoCancelar" > Cancelar	</button>
        </form>        
    </div>
    </div>
    </div>

</div>
@endsection

<style>
/*
    button{
        height:8%;
        width:10%;
    }
  */  
   #botaoConcluir{
        margin-top:20%;
    }
    #botaoCancelar{
        margin-top: -5rem;
        margin-left:12rem;
    }

    #informar{
        margin-top:2%;
        margin-left:3%;
    }

    #dados{
        height:3%;
        width:25%;
    }


</style>