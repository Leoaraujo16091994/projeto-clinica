
@extends ('layouts.layout')

<link href="{{ asset('/css/pacienteDoDia.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/pacienteDoDia.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>


<!-- MODAL PACIENTE EXTRA-->
<div class="modal fade" id="modalPacienteExtra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Qual o paciente você deseja adicionar hoje ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formularioPacienteExtra" name ="formularioPacienteExtra" method= 'post' action="/pacienteExtra">
      @csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nome do Paciente:</label>
            <select id="listaPacienteExtra"  name="paciente" class="form-select" size="10">
              <select>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Sala:</label>
            <select class="form-select" id="salaPacienteExtra" name="salaPacienteExtra">
                      <option></option>
                      <option value="1">Sala A</option>
                      <option value="2">Sala B</option>
                      <option value="3">Sala C</option>
                      <option value="4">Sala D</option>
                      <option value="5">Sala E</option>
                      <option value="7">Sala F</option>
                    </select>
          </div>

          <div class="mb-3">
                    <label for="validationnomeCompleto"> Turno </label>
                    <select class="form-select"  id="turnoPacienteExtra" name = "turnoPacienteExtra">
                      <option></option>
                      <option value="1"> Manhã</option>
                      <option value="2"> Tarde</option>
                      <option value="3"> Noite</option>
                    </select>
                </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="adicionarPacienteExtra()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@section('tituloPagina', 'Pacientes de Hoje')
@section('body')

  <div class="formulario">
        <form id="formulario" name ="formulario" method = 'post' action = '/pacienteDoDia' onkeydown="EnterKeyFilter();">
            @csrf
            <div class="col-12">
             @if( Auth::user()->id == "6" )
              <div class="col-lg-6">
                    <label for="validationnomeCompleto"> Nome Completo </label>
                        <input type="text" class="form-control" value= "{{$requisicao->nomeCompleto}}" id="nomeCompleto" name = "nomeCompleto"> <br>
                </div>
              @endif
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Turno </label>
                    <select class="form-select" value= "{{$requisicao->turno}}" id="turno" name = "turno">
                      <option></option>
                      <option value="1" <?php echo $requisicao->turno =="1"?'selected':'';?> >Manhã</option>
                      <option value="2" <?php echo $requisicao->turno =="2"?'selected':'';?> >Tarde</option>
                      <option value="3" <?php echo $requisicao->turno =="3"?'selected':'';?> >Noite</option>
                    </select>
                </div>
                @if( Auth::user()->id == "6" )

                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Sala </label>
                    <select class="form-select" value= "{{$requisicao->sala}}" id="sala" name = "sala">
                      <option></option>
                      <option value="1" <?php echo $requisicao->sala =="1"?'selected':'';?> >Sala A</option>
                      <option value="2" <?php echo $requisicao->sala =="2"?'selected':'';?> >Sala B</option>
                      <option value="3" <?php echo $requisicao->sala =="3"?'selected':'';?> >Sala C</option>
                      <option value="4" <?php echo $requisicao->sala =="4"?'selected':'';?> >Sala D</option>
                      <option value="5" <?php echo $requisicao->sala =="5"?'selected':'';?> >Sala E</option>
                      <option value="7" <?php echo $requisicao->sala =="7"?'selected':'';?> >Sala F</option>
                    </select>
                </div>
              @endif
            </div>
        </form>
    </div>

    <div class="btn-toolbar" role="toolbar">
    <div class="btn-group btn-group-sm me-2" role="group">
      <button id="btnCadastrar" type="button" onClick="buscarPaciente()" class="btn btn-outline-primary btn-lg" alt="botaoPesquisar"> 
         Pesquisar </button>
    </div>
  
    <div class="btn-group btn-group-sm me-2" role="group">
      <button type="submit" class="btn btn-outline-danger btn-lg" onClick="limparCampos()" alt="botaoLimpar">
        Limpar</button>       
    </div>
  
    <div class="btn-group btn-group-sm me-2" role="group" >
    <button id="btnPacienteExtra" type="button" onClick="abrirModalPacienteExtra()" class="btn btn-outline-success btn-lg" alt="botaoPacienteExtra"> 
         Incluir Paciente</button>  
    </div>
  </div>
  <br><br>

    <table id="lista-pacientes-hoje" class="table table-hover display"  >
        <thead>
            <tr> 
              <th>Id</th>
              <th>Nome Completo</th>
              <th>Chegada</th>
              <th>Chamada</th>
              <th>Observação</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody>
            @if(sizeof($pacientesDoDia) > 0)
              @foreach($pacientesDoDia as $paciente)
              <tr>
                      <td></td>
                      <td> {{$paciente->nome_completo}} </td>
                    @if($paciente->chegou == "1")
                        <td><button type="button" class="btn btn-outline-danger btn-sm" onClick="abrirModalInformarChegadaPaciente({{json_encode($paciente)}})"> Não Chegou</button></td>
                    @else 
                      <td><button type="button" class="btn btn-outline-success btn-sm" disabled> Chegou</button></td>
                    
                    @endif

                    @if($paciente->chamado == "1")
                      <td><button type="button" class="btn btn-outline-danger btn-sm" onClick="abrirModalChamadaPaciente({{json_encode($paciente)}})"> Não Chamado</button></td>
                    @else
                      <td><button type="button" class="btn btn-outline-success btn-sm" disabled>Chamado</button></td>
                    
                    @endif
                      <td id="colunaObservacao"> {{$paciente->observacao}}</td>
                      
                      @if($paciente->chamado == "1")
                        <td > 
                          <div class="dropdown">
                            <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              <span aria-hidden="true" class="fa fa-ellipsis-v fa-2x fa-lg"></span>  
                            </a>
                            
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                            @if( Auth::user()->id == "6" )
                              <li><a class="dropdown-item" href="/pacienteDoDia/{{$paciente->id}}"><h2>Editar</h2></a></li>
                            @endif
                              <li><a class="dropdown-item" onclick="abrirModalExcluirPacienteDoDia({{$paciente->id}})"><h2>Excluir</h2></a></li>
                            </ul>
                          </div>
                        </td>
                        @else

                        <td > 
                          <div class="dropdown">
                            <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              <span aria-hidden="true" class="fa fa-ellipsis-v fa-2x fa-lg"></span>  
                            </a>
                            
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                            @if( Auth::user()->id == "6" )
                              <li><a class="dropdown-item" href="/pacienteDoDia/{{$paciente->id}}"><h2>Editar</h2></a></li>
                            @endif
                              <li><a onClick="abrirModalChamadaPacienteNovamente({{json_encode($paciente)}})" class="dropdown-item"><h2>Chamar Novamente</h2></a></li>                                      
                              <li><a onClick="abrirModalChamadaAcompanhante({{json_encode($paciente)}})" class="dropdown-item"><h2>Chamar Acompanhante</h2></a></li>                                      
                            
                            </ul>
                          </div>
                        </td>
                      @endif                  
                    </tr>
                  </form>
                  @endforeach
            @endif     
          </tbody>
        </table>

<!-- FORMULARIO DE EXLUSAO DO PACIENTE HOJE -->
<form id="formularioExclusao" name ="formularioExclusao" method="post">
  @method('DELETE')
  @csrf
  <input type="text" class="form-control" id="idPacienteExcluido" name="idPacienteExcluido"class="btn btn-light" type="submit">
</form>

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
      <form id="formularioChegada" name ="formularioChegada" method= 'post' >
            @csrf
            <input type="hidden" name="_method" value="PUT">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Observação:</label>
            <input type="text" class="form-control" id="observacao" name="observacao">
          </div>
          <input type="hidden" class="form-control" value=true id="chegadaPaciente" name="chegadaPaciente">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="informaChegadaPaciente()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>



@if(count($pacientesDoDia) > 0) 

<!-- MODAL DE CHAMADA DO PACIENTE --> 
<div class="modal fade" id="modalChamada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja chamar o paciente?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
      <form id="formularioChamada" name ="formularioChamada" method= 'post' action="/pacienteDoDia/{{$paciente->id}}">
      @csrf
            <input type="hidden" name="_method" value="PUT">
          <button type="button" class="btn btn-primary" onClick="chamarPaciente()">Confirmar</button>
          <input type="hidden" class="form-control" value=true id="chamadaPaciente" name="chamadaPaciente">
      <form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endif



@if(count($pacientesDoDia) > 0) 

<!-- MODAL DE CHAMADA DO PACIENTE NOVAMENTE --> 
<div class="modal fade" id="modalChamadaNovamente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja chamar o paciente novamente?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
            <input type="hidden" name="_method" value="PUT">
          <button type="button" class="btn btn-primary" onClick="chamarPacienteNovamente()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endif


@if(count($pacientesDoDia) > 0) 

<!-- MODAL DE CHAMADA DO ACOMPANHANTE DO PACIENTE --> 
<div class="modal fade" id="modalChamadaAcompanhante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja chamar o acompanhante do paciente ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
            <input type="hidden" name="_method" value="PUT">
          <button type="button" class="btn btn-primary" onClick="chamarAcompanhante()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endif



@if(count($pacientesDoDia) > 0) 
<!-- MODAL EXCLUSAO DE PACIENTE DO DIA-->
<div class="modal fade" id="modalExcluirPacienteDoDia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja excluir o paciente HOJE?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="excluirPacienteDoDia({{$paciente->id}})">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endif




<!-- Alert de ERROS-->
<div class="alert alert-danger" style='display:none' id='alert-erro'>
    <ul id="lista">
    </ul>
</div>

<!-- Alert de Sucesso -->
<div class="alert alert-success" style='display:none' id='alert-success'>
   Paciente Cadastrado com sucesso! 
</div>

<!-- Alert Paciente Excluido com Sucesso-->
<div class="alert alert-success" style='display:none' id='alert-exclusao-success'>
   Paciente Excluido com sucesso! 
</div>


<!-- Alert de Erro PACIENTE EXTRA -->
@if(Session::has('errors'))
  <script>
    var erro = ["O paciente já esta cadastrado para hoje"]
    $(document).ready(()=>{
      alertDeErro(erro);
    })
</script>   
@endif





  
@endsection

@section('extra_styles')

@endsection