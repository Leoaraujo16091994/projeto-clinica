
@extends ('layout')


<link href="{{ asset('/css/principal.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/principal.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>



@section('titulodoNavegador', 'Cadastro de Paciente')

@section('body')

<div id = "tituloPagina">
       <h1> Tela Principal </h1>                
</div>

<br>

    <div class="formulario">
        <form id="formulario" name ="formulario" method = 'post' action = '/principal'>
            @csrf
            <div class="col-12">
                <div class="col-lg-6">
                    <label for="validationnomeCompleto"> Nome Completo </label>
                        <input type="text" class="form-control" value= "{{$requisicao->nomeCompleto}}" id="nomeCompleto" name = "nomeCompleto"> <br>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Dias da Semana </label>
                    <select class="form-select" value= "{{$requisicao->diasDaSemana}}" id="diasDaSemana" name = "diasDaSemana">
                      <option></option>
                      
                        <option value="1" <?php echo $requisicao->diasDaSemana=="1"?'selected':'';?> >Seg,Qua e Sex</option>
                        <option value="2" <?php echo $requisicao->diasDaSemana=="2"?'selected':'';?>>Ter,Qui e Sáb</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Turno </label>
                    <select class="form-select" value= "{{$requisicao->turno}}" id="turno" name = "turno">
                      <option></option>
                      <option value="1" <?php echo $requisicao->turno =="1"?'selected':'';?> >Manhã</option>
                      <option value="2" <?php echo $requisicao->turno =="2"?'selected':'';?> >Tarde</option>
                      <option value="3" <?php echo $requisicao->turno =="3"?'selected':'';?> >Noite</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Sala </label>
                    <select class="form-select" value= "{{$requisicao->sala}}" id="sala" name = "sala">
                      <option></option>
                      <option value="1" <?php echo $requisicao->sala =="1"?'selected':'';?> >Sala 1</option>
                      <option value="2" <?php echo $requisicao->sala =="2"?'selected':'';?> >Sala 2</option>
                      <option value="3" <?php echo $requisicao->sala =="3"?'selected':'';?> >Sala 3</option>
                      <option value="4" <?php echo $requisicao->sala =="4"?'selected':'';?> >Sala 4</option>
                      <option value="5" <?php echo $requisicao->sala =="5"?'selected':'';?> >Sala 5</option>
                    </select>
                </div>
              
            </div>
        </form>
    </div>

    <div class="btn-group me-2" role="group">
      <button id="btnCadastrar" type="button" onClick="abrirModalPacienteExtra()" class="btn btn-outline-warning btn-lg" alt="botaoPacienteExtra"> 
         Paciente Extra </button>
    </div>


  <div class="btn-toolbar" role="toolbar">
    <div class="btn-group me-2" role="group">
      <button id="btnCadastrar" type="button" onClick="buscarPaciente()" class="btn btn-outline-primary btn-lg" alt="botaoPesquisar"> 
         Pesquisar </button>
    </div>
  
    <div class="btn-group me-2" role="group">
      <button type="submit" class="btn btn-outline-danger btn-lg" onClick="limparCampos()" alt="botaoLimpar">
        Limpar</button>       
    </div>
  
    <div class="btn-group me-2" role="group" >
      <button type="submit" class="btn btn-outline-success btn-lg" onClick="validarCamposFormulario()" alt="botaoCadastrar"> Cadastrar</button>       
    </div>
  </div>


            <div class="col-lg-12">
                <div class="tableFixHead">
                    <table>
                        <caption class="text-center">Quadro de Pacientes de Hoje</caption>
                        <thead>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Chegada</th>
                                <th>Chamada</th>
                                <th>Observação</th>
                            </tr>
                        </thead>

                        <tbody>
                                @foreach($pacientesDoDia as $paciente)
                                <tr>
                                  <td> {{$paciente->nome_completo}} </td>
                                @if($paciente->chegou == "1")
                                    <td><button type="button" class="btn btn-outline-danger" onClick="abrirModalInformarChegadaPaciente({{json_encode($paciente)}})"> Não Chegou</button></td>
                                @else 
                                  <td><button type="button" class="btn btn-outline-success" disabled> Chegou</button></td>
                                
                                @endif

                                @if($paciente->chamado == "1")
                                  <td><button type="button" class="btn btn-outline-danger" onClick="informarChegadaPaciente()"> Não Chamado</button></td>
                                @else
                                  <td><button type="button" class="btn btn-outline-success" disabled>Chamado</button></td>
                                
                                @endif
                                  <td id="colunaObservacao"></td>
                                </tr>
                              @endforeach
                        </tbody>
                    </table>
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


<!-- MODAL DE CHEGADA DO PACIENTE --> 
<div class="modal fade" id="modalChegada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja informar chegada do paciente?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Observação:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="informaChegadaPaciente()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>




<!-- MODAL DE CHAMADA DO PACIENTE --> 
<div class="modal fade" id="modalChamada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja chamar o paciente?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="chamaPaciente()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>




<!-- MODAL PACIENTE EXTRA-->
<div class="modal fade" id="modalPacienteExtra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Qual o paciente você quer adicionar hoje ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nome Completo:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="informaChegadaPaciente()">Confirmar</button>
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