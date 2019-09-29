
@extends ('layout')

@section('titulodoNavegador')
   Chamar Paciente
@endsection



@section('body')


  <div id = "titulopagina">
        <h1> Chamar Paciente </h1>                
  </div>


  <div id="dados">
      <form method='post' id="chamarPainel" action ='/chamarpainel'>
      @csrf

          <label for="validationnomeCompleto"> Nome Completo </label>
              <input name="nomeCompleto" id="nomeCompleto" class="form-control" placeholder="Nome">
            
          <label> Sala </label>
              <input type="text" class="form-control" placeholder="Número da Sala" id="sala"  name = "sala" required><br>


          <label>Tipo </label><br>
              <input type = "checkbox" name ="chamada" value = 'T'> Troca 
              <input type = "checkbox" name ="chamada" value = 'E'> Extra 	<br>

      </form>       

    <button type="submit" id="botaoChamar" class="btn btn-block btn-primary" alt="botaoChamar"  onClick="som()">Chamar</button>
  
  </div>
        
     
        <button type="submit" id="botaoLembrar" class="btn btn-info"   onClick="lembrarSom()"> Chamar Novamente </button>
        <button type="submit" id="botaoCorrigr" class="btn btn-danger" onClick="corrigir()"> Corrigir </button>


<script>
    function som(){
      const form= document.querySelector('form');
      const audio = new Audio('/alerta.mp3');

    
      console.log('som');
      audio.play();
      setTimeout(() => {
        console.log('submete');
        document.getElementById('chamarPainel').submit();
      }, 3000);
    }





    function lembrarSom(){
      const form= document.querySelector('form');
      const audio = new Audio('/alerta.mp3');

    
      console.log('som');
      audio.play();
     
    }



</script>




<div class="table-wrapper-scroll-y my-custom-scrollbar">

<table class="table table-bordered table-striped mb-0">
  <thead>
    <tr>
      <th scope="col">  Nome Completo </th>
      <th scope="col">  Chegou  </th>
      <th scope="col">  Chamado </th>
    </tr>
  </thead>
  <tbody>
    <tr>
    @foreach($pacientes as $paciente)
        <tr>
            <td>{{$paciente->nome_completo}}</td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
     
    </tr>
  </tbody>
</table>

</div>



<br><br>











@endsection


<style>
  #dados{
      width:50%;
      margin-top:2%;
      margin-left:3%;
      font-size:130%;
  }

  button{
    height:8%;
    width:29%;
  }

 

  #painel{
    width:500px;
    margin-left:690px;
    margin-top:-300px;
  }

  #painel .bg-primary {
    text-align:center;
  }

  #datatable-checkbox{
    margin-left:130%;
    margin-top:-50%;
  }

  #botaoLembrar{
    height:8%;
    width:20%;
    margin-left:3%;
  }

  .my-custom-scrollbar {
position: relative;
height: 200px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}


</style>




   