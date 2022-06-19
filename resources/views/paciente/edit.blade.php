
@extends ('layouts.layout')


<link href="{{ asset('/css/paciente.css') }}" rel="stylesheet" type="text/css" >
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/paciente.js') }}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<meta  charset =" UTF-8 " />
<meta  name =" viewport " content =" largura=largura do dispositivo, escala inicial=1.0 " />
<meta  http-equiv =" Compatível com X-UA " content =" ie=edge " />


@section('body')

<div id = "tituloPagina">
       <h1>Editar Paciente </h1>                
</div>

<br>
    <div class="formulario">
        <form id="formulario" name ="formulario" method = 'post' action = '/paciente/{{$pacienteSelecionado[0]->id}} '>
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="col-12">
                <div class="col-lg-6">
                    <label for="validationnomeCompleto"> Nome Completo </label>
                        <input type="text" class="form-control" value= "{{$pacienteSelecionado[0]->nome_completo}}" id="nomeCompleto" name = "nomeCompleto"> <br>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Dias da Semana </label>
                    <select class="form-select" value= "{{$pacienteSelecionado[0]->diasDaSemana}}" id="diasDaSemana" name = "diasDaSemana">
                      <option></option>
                      
                        <option value="1" <?php echo $pacienteSelecionado[0]->dias_semana=="1"?'selected':'';?> >Seg,Qua e Sex</option>
                        <option value="2" <?php echo $pacienteSelecionado[0]->dias_semana=="2"?'selected':'';?>>Ter,Qui e Sáb</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Turno </label>
                    <select class="form-select" value= "{{$pacienteSelecionado[0]->turno}}" id="turno" name = "turno">
                      <option></option>
                      <option value="1" <?php echo $pacienteSelecionado[0]->turno =="1"?'selected':'';?> >Manhã</option>
                      <option value="2" <?php echo $pacienteSelecionado[0]->turno =="2"?'selected':'';?> >Tarde</option>
                      <option value="3" <?php echo $pacienteSelecionado[0]->turno =="3"?'selected':'';?> >Noite</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Sala </label>
                    <select class="form-select" value= "{{$pacienteSelecionado[0]->sala}}" id="sala" name = "sala">
                      <option></option>
                      <option value="1" <?php echo $pacienteSelecionado[0]->sala =="1"?'selected':'';?> >Sala A</option>
                      <option value="2" <?php echo $pacienteSelecionado[0]->sala =="2"?'selected':'';?> >Sala B</option>
                      <option value="3" <?php echo $pacienteSelecionado[0]->sala =="3"?'selected':'';?> >Sala C</option>
                      <option value="4" <?php echo $pacienteSelecionado[0]->sala =="4"?'selected':'';?> >Sala D</option>
                      <option value="5" <?php echo $pacienteSelecionado[0]->sala =="5"?'selected':'';?> >Sala E</option>
                    </select>
                </div>
              
            </div>
        </form>
    </div>
    
    <div class="btn-toolbar" role="toolbar">
  
      <div class="btn-group me-2" role="group" >
        <button type="submit" class="btn btn-outline-success btn-lg" onClick="validarCamposFormularioCadastrar()" alt="botaoCadastrar"> Salvar</button>       
      </div>
      <div class="btn-group me-2" role="group">
        <button type="submit" class="btn btn-outline-danger btn-lg"  alt="botaoCancelar">
        <a href="/paciente" style="color:inherit"> Cancelar </a>
          </button>       
      </div>
    
  </div>
<!-- MODAL CONFIRMAÇÃO DE ATUALIZACAO DE PACIENTE-->
<div class="modal fade" id="modalConfirmacaoCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja atualizar o paciente?</h5>
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



<!-- Alert Paciente Cadastrado com Sucesso-->
<div class="alert alert-success" style='display:none' id='alert-success'>
   Paciente atualizado com sucesso! 
</div>

@endsection

@section('extra_styles')

@endsection