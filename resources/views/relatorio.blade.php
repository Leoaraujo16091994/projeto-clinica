@extends ('layout')

@section('titulodoNavegador', 'Relatorios')

@section('body')


<div id = "titulopagina">
       <h1> Relatorios </h1>                
</div>

<br>


        <div id ="datas">  
          <form  method="get" action='/relatoriospronto' id = "formularioDatas" >
            @csrf

          <label for="validationDataInicial">Data Inicial </label>
            <input	type="date" class="form-control" placeholder=" Data Inicial" id="dataInicial" name ="dataInicial" >

            <br>
            <label for="validationDataFinal">Data Final </label>
            <input	type="date" class="form-control" placeholder=" Data Final" id="dataFinal" name ="dataFinal" >
            
            <br>
            
            <div id="botaoConcluir">
                <button type = "submit" class="btn btn-primary btn-lg" alt="botaoConcluir ">  Pesquisar </button>
           </div>           
        </form>
      </div>


@endsection






<style>
    #datas{
      width:25%;
    }
</style>