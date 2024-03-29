
@extends ('layout')

@section('titulodoNavegador')
   Chamar Paciente
@endsection
 


@section('body')


  <div id = "titulopagina">
        <h1> Chamar Paciente </h1>                
  </div>


  <div id="dados">
      <form name ="chamarPainel" method='post' id="chamarPainel" action ='/chamarpainel' >
      @csrf

          <label for="validationnomeCompleto"> Nome Completo </label>
              <input autocomplete= "off"  name="nomeCompleto" id="nomeCompleto" class="form-control" placeholder="Nome" >
              <div id="lista" > </div>
          <label> Sala </label>
              <input type="text" class="form-control" placeholder="Número da Sala" id="sala"  name = "sala" required><br>


          <label>Tipo </label><br>
              <input type = "checkbox" name ="chamada" value = 'T'> Troca 
              <input type = "checkbox" name ="chamada" value = 'E'> Extra 	<br>

      </form>       

    <button type="submit" id="botaoChamar" class="btn btn-block btn-primary" alt="botaoChamar"  onClick="som()">Chamar</button>
  
  </div>
             
        <button type="submit" id="botaoLembrar" class="btn btn-info"   onClick="lembrarSom()"> Chamar Novamente </button>


      <div id = "botaoCorrigir">
          <form action = '/deletar'method='get'>
              <input type="hidden" name="_method" >
                <button type="submit" id="botaoCorrigr" class="btn btn-danger" onClick="corrigir()"> Corrigir </button>
          </form>
      </div>


<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-bordered table-striped mb-0">
      <thead>
        <tr>
          <th scope="col">  Nome Completo </th>
        </tr>
      </thead>
      <tbody>
        <tr>
@if($contador == 0 )
      <tr>
          <td>{{'vazio'}}</td>
      </tr>

    @else
        @foreach($pacientes as $paciente)     
            <tr>
                <td>{{$paciente->nome_completo}}</td>
            </tr>
        @endforeach
  @endif
        
        </tr>
      </tbody>
    </table>
</div>


<script src="/js/jquery.min.js"></script>



<script>

function som(){
        var nome = chamarPainel.nomeCompleto.value;
        var sala = chamarPainel.sala.value;
        
        if(nome ==""){
            alert("Informe o Nome Completo");
            return 0;
        } else if(sala == ""){
            alert("Informe a Sala");
            return 0;
         } else{

      const form= document.querySelector('form');
      const audio = new Audio('/alerta.mp3');

    
      console.log('som');
      audio.play();
      setTimeout(() => {
        console.log('submete');
        document.getElementById('chamarPainel').submit();
      }, 4000);
    }
  }




    function lembrarSom(){
        const form= document.querySelector('form');
        const audio = new Audio('/alerta.mp3');    
        console.log('som');
        audio.play();
    }



$('#nomeCompleto').keyup(function(){
    var query = $(this).val();
    if(query != '') {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('autocomp.fetch') }}",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
                $('#lista').fadeIn();  
                $('#lista').html(data);
            }
        });
    }
});

$('#lista').on('click', 'li', function(){  
    $('#nomeCompleto').val($(this).text());  
    $('#lista').fadeOut();  
});

</script>



<br><br>

@endsection


<style>
      #lista{
        position:fixed;
      }
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
    width:27%;
    margin-left:3%;
  }

  .my-custom-scrollbar {
    position: relative;
    height: 70%;
    width:60%;
    margin-left:60%;
    margin-top:-38%;
    overflow: auto;
    background-color:#ffffff;
  }

  .table-wrapper-scroll-y {
    display: block;
  }


  #botaoCorrigir{
    width:76%;
    margin-top:-4.1em;
    margin-left:31%;
  }

  td{
    color:#000000;
  }

</style>




   