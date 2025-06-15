
@extends ('layouts.layout')


<link href="{{ asset('/css/pacienteDoDia.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/pacienteDoDia.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>



@section('tituloPagina', 'Editar Pacientes de Hoje')
@section('body')

  <div class="formulario">
        <form id="formularioEdicao" name ="formularioEdicao" method = 'post' action = '/pacienteDoDia/{{$pacienteSelecionado[0]->id}}' onkeydown="EnterKeyFilter();">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="col-12">
             
              <div class="col-lg-6">
                    <label for="validationnomeCompleto"> Nome Completo </label>
                        <input type="text" class="form-control" value= "{{$pacienteSelecionado[0]->nome_completo}}" id="nomeCompleto" name = "nomeCompleto" disabled> 
                </div>
                <div class="col-lg-2">
                    <label for="validationTurno"> Turno </label>
                    <select class="form-select" value= "{{$pacienteSelecionado[0]->turno_do_dia}}" id="turno_do_dia" name = "turno_do_dia">
                      <option value="1" <?php echo $pacienteSelecionado[0]->turno_do_dia =="1"?'selected':'';?> >Manhã</option>
                      <option value="2" <?php echo $pacienteSelecionado[0]->turno_do_dia =="2"?'selected':'';?> >Tarde</option>
                      <option value="3" <?php echo $pacienteSelecionado[0]->turno_do_dia =="3"?'selected':'';?> >Noite</option>
                    </select>
                </div>
                

                <div class="col-lg-2">
                    <label for="validationSala"> Sala </label>
                    <select class="form-select" value= "{{$pacienteSelecionado[0]->sala_do_dia}}" id="sala_do_dia" name = "sala_do_dia">
                      <option value="1" <?php echo $pacienteSelecionado[0]->sala_do_dia =="1"?'selected':'';?> >Sala A</option>
                      <option value="2" <?php echo $pacienteSelecionado[0]->sala_do_dia =="2"?'selected':'';?> >Sala B</option>
                      <option value="3" <?php echo $pacienteSelecionado[0]->sala_do_dia =="3"?'selected':'';?> >Sala C</option>
                      <option value="4" <?php echo $pacienteSelecionado[0]->sala_do_dia =="4"?'selected':'';?> >Sala D</option>
                      <option value="5" <?php echo $pacienteSelecionado[0]->sala_do_dia =="5"?'selected':'';?> >Sala E</option>
                      <option value="7" <?php echo $pacienteSelecionado[0]->sala_do_dia =="7"?'selected':'';?> >Sala F</option>
                    </select>
                    <br>
                </div>
              
                <div class="col-lg-6">
                <label for="validationObservacao">Observação:</label>
                  <input type="text" class="form-control" id="observacao" name="observacao">
                </div>


                <div class="col-lg-2">
                    <label for="validationChegou"> Chegou</label>
                    <select class="form-select" value= "{{$pacienteSelecionado[0]->chegou}}" id="chegou" name = "chegou">
                      <option value="2" <?php echo $pacienteSelecionado[0]->chegou =="2"?'selected':'';?> >Sim</option>
                      <option value="1" <?php echo $pacienteSelecionado[0]->chegou =="1"?'selected':'';?> >Não</option>
                    </select>
                </div>



                <div class="col-lg-2">
                    <label for="validationChamado"> Chamado </label>
                    <select class="form-select" value= "{{$pacienteSelecionado[0]->chamado}}" id="chamado" name = "chamado">
                      <option value="2" <?php echo $pacienteSelecionado[0]->chamado =="2"?'selected':'';?> >Sim</option>
                      <option value="1" <?php echo $pacienteSelecionado[0]->chamado =="1"?'selected':'';?> >Não</option>
                    </select>
                </div>
                <input type="hidden" class="form-control" value=true id="pacienteAlterado" name="pacienteAlterado">
          </div>
        </form>
    </div>

    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group btn-group-sm me-2" role="group">
          <button id="btnSalvar" type="button" onClick="alterarPaciente()" class="btn btn-outline-success btn-lg" alt="botaoSalvar"> 
            Salvar </button>
        </div>
    
        <div class="btn-group btn-group-sm me-2" role="group">
        <button type="submit" class="btn btn-outline-danger btn-lg"  alt="botaoCancelar">
        <a href="/pacienteDoDia" style="color:inherit"> Cancelar </a>
          </button>       
      </div>
  
    </div>
  

<!-- MODAL CONFIRMAÇÃO DE CADASTRO DE PACIENTE-->
<div class="modal fade" id="modalConfirmacaoCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja Cadastrar o paciente?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="confirmarCadastro()">Confirmar</button>
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