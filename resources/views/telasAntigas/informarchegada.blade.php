@extends('layout')

<link href="{{ asset('/css/informarChegada.css') }}" rel="stylesheet" type="text/css" >
<!--<script type="text/javascript" src="{{ URL::asset('js/informarChegada.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>



@section('titulodoNavegador')
    Informar Chegada
@endsection


@section('body')

<div id = "tituloPagina">
       <h1> Informar Chegada </h1>                
</div>

<br><br>

<div id="informar">
        <form method='post' action ='/chegada' name="formulario">
            @csrf
            <div class="col-12">
                <div class="col-lg-6">
                    <label for="validationnomeCompleto"> Nome Completo </label>
                    <input autocomplete= "off" type="text" class="form-control" placeholder="Nome Completo" id="nomeCompleto"  name = "nomeCompleto" >
                </div>
            </div>

            <div class="col-lg-6">
                <div class="tableFixHead">
                    <table>
                        <caption class="text-center">Quadro de Pacientes de Hoje</caption>
                        <thead>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Leonardo Amancio de Araujo</td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            <tr>
                                <td>Ingryd Rocha Saraiva de Araujo</td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            <tr>
                                <td>Olivia Rocha de Araujo</td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            <tr>
                                <td>Celia Cristina Amancio de Oliveira</td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            <tr>
                                <td>E1</td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            <tr>
                                <td>A1</td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            <tr>
                                <td>B1</td>
                                <td>B2</td>
                            </tr>
                            <tr>
                                <td>C1</td>
                                <td>C2</td>
                            </tr>
                            <tr>
                                <td>D1</td>
                                <td>D2</td>
                            </tr>
                            <tr>
                                <td>E1</td>
                                <td>E2</td>
                            </tr>
                            <tr>
                                <td>A1</td>
                                <td>A2</td>
                            </tr>
                            <tr>
                                <td>B1</td>
                                <td>B2</td>
                            </tr>
                            <tr>
                                <td>C1</td>
                                <td>C2</td>
                            </tr>
                            <tr>
                                <td>D1</td>
                                <td>D2</td>
                            </tr>
                            <tr>
                                <td>E1</td>
                                <td>E2</td>
                            </tr>
                            <tr>
                                <td>A1</td>
                                <td>A2</td>
                            </tr>
                            <tr>
                                <td>B1</td>
                                <td>B2</td>
                            </tr>
                            <tr>
                                <td>C1</td>
                                <td>C2</td>
                            </tr>
                            <tr>
                                <td>D1</td>
                                <td>D2</td>
                            </tr>
                            <tr>
                                <td>E1</td>
                                <td>E2</td>
                            </tr>
                            <tr>
                                <td>A1</td>
                                <td>A2</td>
                            </tr>
                            <tr>
                                <td>B1</td>
                                <td>B2</td>
                            </tr>
                            <tr>
                                <td>C1</td>
                                <td>C2</td>
                            </tr>
                            <tr>
                                <td>D1</td>
                                <td>D2</td>
                            </tr>
                            <tr>
                                <td>E1</td>
                                <td>E2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

          

</div>



<!--
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
-->


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
/*
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
    */


</style>