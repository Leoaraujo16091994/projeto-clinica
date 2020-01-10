@extends('layout')


@section('titulodoNavegador')
    Informar Chegada
@endsection


@section('body')

<div id = "titulopagina">
       <h1> Informar Chegada </h1>                
</div>

    <br><br>
    <div id="informar">
        <form method='post' action ='/chegada' name="formulario">
            @csrf

            <label for="validationnomeCompleto"> Nome Completo </label>
            <input autocomplete= "off" type="text" class="form-control" placeholder="Nome Completo" id="nomeCompleto"  name = "nomeCompleto" >
            <div id="lista" > </div>
            <br><br><br>
       
         
              
        <div class="row">
            <div class="col-sm-9 col-md-15 col-lg-30">
                <div id="botaoConcluir">
                    <button type="button" class="btn btn-primary btn-lg" alt="botaoConcluir" onclick="validar()">  Concluir </button> 
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

<script src="/js/jquery.min.js"></script>


<script>

function validar(){
    var nome = formulario.nomeCompleto.value;

    if(nome == ""){
        alert("Você Deve Informar Um Nome");
    } else {
        alert("Chegada Informada");
        document.formulario.submit();
        return true;
    }
}


$('#nomeCompleto').keyup(function(){
    var query = $(this).val();
    if(query != '') {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('autocomplete.fetch') }}",
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


@endsection






<style>

   #botaoConcluir{
        margin-top:;
    }

    #botaoCancelar{
        margin-top: -6.5rem;
        margin-left:15rem;
    }

    #informar{
        margin-top:2%;
        margin-left:3%;
    }

    #informar input{
        height:5%;
        width:50%;
    }


</style>