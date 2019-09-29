
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

        <br>
        

<label>Tipo </label><br>

<input type = "checkbox" name ="chamada" value = 'T'> Troca 
<input type = "checkbox" name ="chamada" value = 'E'> Extra 	<br>
      </form>       
        
          
          <button type="submit" id="botaoChamar" class="btn btn-block btn-primary" alt="botaoChamar"  onClick="som()">Chamar</button>
  </div>
        


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

</script>


















    <table class="table table-bordered">
        <thead>
            <caption>Monthly savings</caption>
              <th>Nome</th>
              <th> Chegou</th>
              <th> Chamado  </th>
              <th> Ação  </th>
        </thead>
        
        <tbody>
              @foreach($pacientes as $paciente)
              <tr>
                <td>{{$paciente->nome_completo}}</td>
              </tr>
              @endforeach
        <tbody>
    </table>






@endsection


<style>
  #dados{
      width:50%;
      margin-top:2%;
      margin-left:3%;
  }

  button{
    height:8%;
    width:30%;
  }

  #botaoCancelar{
    margin-top:-15%;
    margin-left:40%;
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

  

</style>




   