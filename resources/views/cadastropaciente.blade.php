
@extends ('layout')

@section('titulodoNavegador', 'Cadastro de Paciente')

@section('body')

<script>
    function validar() {

        var nome = formulario.nomeCompleto.value;
        var dataNascimento = formulario.dataNascimento.value;
        var status = formulario.status.value;
        var tpSangue = formulario.tpSanguineo.value;
        var convenio = formulario.convenio.value;

        if(nome ==""){
            alert("Informe o Nome Completo");
            return 0;
        } else if(dataNascimento == ""){
            alert("Informe a Data de Nascimento");
            return 0;
        } else if(status == "") {
                alert("Você deve escolher um Status");
        } else if(tpSangue.checked == false) {
                alert("Você deve escolher um Tipo Sanguineo");
        } else if(convenio.checked == false) {
                alert("Você deve escolher um Convênio");
        }else {
            alert("Paciente Cadastrado Sucesso!!!");
            document.formulario.submit();
            return true;
        }
        }
</script>


<div id = "titulopagina">
       <h1> Cadastro de Paciente </h1>                
</div>



    <div id="dados">
        <form name ="formulario" method = 'post' action = '/pacientes'>
            @csrf

            <label for="validationnomeCompleto"> Nome Completo </label>
                <input type="text" class="form-control" placeholder="Nome Completo" id="nomeCompleto"  name = "nomeCompleto" > <br>

            <label for="validationdataNascimento"> Data de Nascimento </label>
                <input	type="date" class="form-control" placeholder=" Data" id="dataNascimento" name ="dataNascimento"  >

            <br>

            <label> Convênio do Paciente </label><br>

                <input type = "checkbox" name ="convenio" value = 'Particular'> Particular
                <input type = "checkbox" name ="convenio" value = 'Sus'> Sus 	<br>


            <div id = 'segundaParte'>
            
        <div class="row">
          <div class="col-md-18">


                <label> Dias da Semana </label>  <br>
                    <input type = "checkbox" name ="segundaFeira" > Segunda-Feira  <br>
                    <input type = "checkbox" name ="tercaFeira" > Terça-Feira  	<br>
                    <input type = "checkbox" name ="quartaFeira"> Quarta-Feira  	<br>
                    <input type = "checkbox" name ="quintaFeira"> Quinta-Feira  	<br>
                    <input type = "checkbox" name ="sextaFeira" > Sexta-Feira  	<br>
                    <input type = "checkbox" name ="sabado" > Sábado  	<br>

                    <br>

                <label> Paciente é Soro Positivo? </label> <br>
                    <input type = "checkbox" name ="tpSanguineo" value ="SIM"> SIM  
                    <input type = "checkbox" name ="tpSanguineo" value ="nao"> Não  <br>


<br>
     
                    <label>Status do Paciente </label> <br>
                        <select name="status">
                            <option value="Em Tratamento" selected >Em Tratamento </option> 
                            <option value="Obito" >Obito</option>
                            <option value="Trânsito"> Trânsito</option>
                            <option value="Abandono"  >Abandono</option> 
                            <option value="Transferido" >Transferido</option>
                            <option value="Internado"> Internado</option>
                            <option value="Recuperou Função"> Recuperou Função</option>
                        </select>

<br><br>
            </div>
        </div>
    </div>


            <div id="botaoCadastrar">
                <button type="button"  class="btn btn-primary btn-lg" alt="botaoCadastrar" onclick="validar()">  Cadastrar </button>
            </div>           
        </form>


        <div id="botaoCancelar">
            <form action = "/paginainicial">
                <button type="submit" class="btn btn-info btn-lg" alt="botaoCancelar"> Cancelar	</button>
            </form>        

            </div>
    
    </div>


@endsection

@section('extra_styles')

<style>

    #botaoCancelar{
        margin-top:-5rem;
        margin-left:15rem;
    }

    label{
        font-size:130%;
    }

    #nomeCompleto{
        height:5%;
        width:50%;
    }

    #dataNascimento{
        height:5%;
        width:16%;
    }

    #dados{
        margin-top:2%;
        margin-left:3%;
        font-size:15px;
    }

    #segundaParte{
        margin-top:-25rem;
        margin-left:70%;
    }

</style>
    @endsection