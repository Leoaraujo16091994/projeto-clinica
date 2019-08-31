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





<!--

    <div class="right_col" role="main">
          <div class="row top_tiles">
            <div class="animated flipInY col-lg-4 col-md-5 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count"> 179</div>
                  <h3> Total de Extras </h3>
                </div>
              </div>
    




            <div class="animated flipInY col-lg-4 col-md-5 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count"> 179</div>
                  <h3> Total de Faltas </h3>
                </div>
            </div>
    
            <div class="animated flipInY col-lg-4 col-md-5 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count">179</div>
                  <h3>  Total de Sessões  </h3>
                </div>
              </div>
            </div>
        </div>




-->










@endsection






<style>
    #datas{
      width:25%;
    }
</style>