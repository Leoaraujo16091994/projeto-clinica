
@extends ('layouts.layout')

<script type="text/javascript" src="{{ URL::asset('js/paciente.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<link href="{{ asset('/css/paciente.css') }}" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

@section('tituloPagina', 'Pacientes')

@section('body')

<div class="formulario">
    <form id="formulario" name ="formulario" method = 'post' action = '/paciente' onkeydown="EnterKeyFilter();">
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
                  <option value="1" <?php echo $requisicao->sala =="1"?'selected':'';?> >Sala A</option>
                  <option value="2" <?php echo $requisicao->sala =="2"?'selected':'';?> >Sala B</option>
                  <option value="3" <?php echo $requisicao->sala =="3"?'selected':'';?> >Sala C</option>
                  <option value="4" <?php echo $requisicao->sala =="4"?'selected':'';?> >Sala D</option>
                  <option value="5" <?php echo $requisicao->sala =="5"?'selected':'';?> >Sala E</option>
                  <option value="7" <?php echo $requisicao->sala =="7"?'selected':'';?> >Sala F</option>
                </select>
            </div>
          
        </div>
    </form>
</div>

  <div class="btn-toolbar" role="toolbar">
    <div class="btn-group  btn-group-sm me-2" role="group">
      <button id="btnCadastrar" type="button" onClick="buscarPaciente()" class="btn btn-outline-primary btn-lg" alt="botaoPesquisar"> 
         Pesquisar </button>
    </div>
  
    <div class="btn-group  btn-group-sm me-2" role="group">
      <button type="submit" class="btn btn-outline-danger btn-lg" onClick="limparCampos()" alt="botaoLimpar">
        Limpar</button>       
    </div>
    @if( Auth::user()->id == "6" )
    <div class="btn-group  btn-group-sm me-2" role="group" >
      <button type="submit" class="btn btn-outline-success btn-lg" onClick="validarCamposFormularioCadastrar()" alt="botaoCadastrar"> Cadastrar</button>       
    </div>
    @endif
  </div>

  
<br>
<br>


                  <table id="lista-pacientes" class="table table-hover display"  >
                        <thead>
                            <tr>
                                <th style="width:70%;">Nome Completo</th>
                                <th style="width:20%;">Dias Da Semana</th>
                                <th style="width:20%;">Turno</th>
                                <th>Sala</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($pacientes) > 0)
                          @foreach($pacientes as $paciente)
                              <tr>
                                  <td> {{$paciente->nome_completo}} </td>
                                  <td> 
                                      @if($paciente->dias_semana ==1)
                                        Seg,Quar e Sex
                                      @else
                                        Ter,Qui e Sáb
                                      @endif
                                  </td>
                                  <td>
                                      @if($paciente->turno ==1)
                                        Manhã
                                      @elseif($paciente->turno ==2)
                                        Tarde
                                      @else
                                        Noite
                                      @endif
                                  </td>
                                  <td>
                                      @switch($paciente->sala)
                                        @case(1)
                                          A 
                                        @break
                                        @case(2)
                                          B
                                        @break
                                        @case(3)
                                          C
                                        @break
                                        @case(4)
                                          D
                                        @break
                                        @case(5)
                                          E
                                        @break
                                    @endswitch
                                  </td>
                                  <td > 
                                    <div class="dropdown">
                                      <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span aria-hidden="true" class="fa fa-ellipsis-v fa-2x fa-lg"></span>  
                                      </a>
                                      
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="/paciente/{{$paciente->id}}"><h2>Editar</h2></a></li>
                                        <li><a class="dropdown-item" onclick="abrirModalExcluirPaciente({{$paciente->id}})"><h2>Excluir</h2></a></li>
                                        
                                      </ul>
                                    </div>
                                  </td>
                                </tr>
                              @endforeach
                        @endif 
                        </tbody>
                    </table>
             
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

@if(sizeof($pacientes) > 0)
<!-- MODAL EXCLUSAO DE PACIENTE-->
<div class="modal fade" id="modalExcluirPaciente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja Excluir o paciente?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="excluirPaciente({{$paciente->id}})">Confirmar</button>
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



<!-- Alert Paciente Cadastrado com Sucesso-->
<div class="alert alert-success" style='display:none' id='alert-success'>
   Paciente Cadastrado com sucesso! 
</div>



<!-- Alert Paciente Excluido com Sucesso-->
<div class="alert alert-success" style='display:none' id='alert-exclusao-success'>
   Paciente Excluido com sucesso! 
</div>



<form style="display:none"id="formularioExclusao" name ="formularioExclusao" method="post">
  @method('DELETE')
  @csrf
  <input type="text" class="form-control" id="idPacienteExcluido" name="idPacienteExcluido"class="btn btn-light" type="submit">
</form>


@endsection

@section('extra_styles')

@endsection