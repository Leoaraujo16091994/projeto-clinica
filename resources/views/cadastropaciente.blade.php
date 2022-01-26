
@extends ('layout')


<link href="{{ asset('/css/cadastroPaciente.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/cadastroPaciente.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>



@section('titulodoNavegador', 'Cadastro de Paciente')

@section('body')

<div id = "tituloPagina">
       <h1> Cadastro de Paciente </h1>                
</div>

<br><br>

    <div class="formulario">
        <form id="form" name ="formulario" method = 'post' action = '/pacientes'>
            @csrf
            <div class="col-12">
                <div class="col-lg-7">
                    <label for="validationnomeCompleto"> Nome Completo </label>
                        <input type="text" class="form-control" placeholder="Nome Completo" id="nomeCompleto"  name = "nomeCompleto" > <br>
                </div>

                <div class="col-lg-5">
                    <label for="validationdataNascimento"> Data de Nascimento </label>
                    <input	type="date" class="form-control" placeholder=" Data" id="dataNascimento" name ="dataNascimento"  >
                </div>

                <div class="col-lg-7">
                    <label> Dias da Semana </label>  <br>
                        <input type = "checkbox" class="diasDaSemana" name ="segundaFeira" > Segunda-Feira  <br>
                        <input type = "checkbox" class="diasDaSemana" name ="tercaFeira" > Terça-Feira  	<br>
                        <input type = "checkbox" class="diasDaSemana" name ="quartaFeira"> Quarta-Feira  	<br>
                        <input type = "checkbox" class="diasDaSemana" name ="quintaFeira"> Quinta-Feira  	<br>
                        <input type = "checkbox" class="diasDaSemana" name ="sextaFeira" > Sexta-Feira  	<br>
                        <input type = "checkbox" class="diasDaSemana" name ="sabado" > Sábado  	<br>
                </div>
                
                <div id ="segundaParte">
                    <div class="col-lg-5">
                        <label> Paciente é Soro Positivo? </label> <br>
                            <input type = "radio" id = "tpSanguineo" name ="tpSanguineo" value ="SIM"> SIM  
                            <input type = "radio" id = "tpSaguineo" name ="tpSanguineo" value ="nao"> Não  
                    </div>
                    
                    <div class="col-lg-5" style="padding-top:10px;">
                        <label> Convênio do Paciente </label><br>
                            <input type = "radio" name ="convenio" value = 'Particular'> Particular
                            <input type = "radio" name ="convenio" value = 'Sus'> Sus 	<br>
                    </div>

                    <div class="col-lg-5" style="padding-top:10px;">
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
                    </div>
                </div>
               
            </div>
            
            <div id="botaoCadastrar">
                <button id="btnCadastrar" type="button" onClick="validarCamposFormulario()" class="btn btn-outline-primary btn-lg" alt="botaoCadastrar" >  Cadastrar </button>
            </div>   
        </form>
    </div>
        
    <div id="botaoCancelar">
        <button type="submit" class="btn btn-outline-danger btn-lg" alt="botaoCancelar" data-bs-toggle="modal" data-bs-target="#exampleModalCancelamento"> Cancelar</button>       
    </div>
       

<!-- Modal de confirmação-->
<div class="modal fade" id="modalConfirmacaoCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja cadastrar paciente?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="confirmarCadastro()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal de cancelamento-->
<div class="modal fade" id="exampleModalCancelamento" tabindex="-1" aria-labelledby="exampleModalLabelCancelamento" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelCancelamento">Tem certeza que deseja sair?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
      <form action = "/paginainicial">
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </form> 
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<!-- Alert de ERROS-->
<div class="alert alert-danger" style='display:none' id='alert-erro'>
    <ul id="lista">
    </ul>
</div>



<!-- Alert de Sucesso -->
<div class="alert alert-success" style='display:none' id='alert-success'>
   Paciente Cadastrado com sucesso! 
</div>


@endsection

@section('extra_styles')

@endsection