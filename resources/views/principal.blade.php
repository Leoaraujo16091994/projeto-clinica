
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
        <form id="form" name ="formulario" method = 'post' action = '/principal'>
            @csrf
            <div class="col-12">
                <div class="col-lg-6">
                    <label for="validationnomeCompleto"> Nome Completo </label>
                        <input type="text" class="form-control" id="nomeCompleto" name = "nomeCompleto" > <br>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Dias da Semana </label>
                    <select class="form-select" id="diasDaSemana" name = "diasDaSemana">
                      <option></option>
                      <option value="1">Seg,Qua e Sex</option>
                      <option value="2">Ter,Qui e Sáb</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Turno </label>
                    <select class="form-select" id="turno" name = "turno">
                      <option></option>
                      <option value="1">Manhã</option>
                      <option value="2">Tarde</option>
                      <option value="3">Noite</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="validationnomeCompleto"> Sala </label>
                    <select class="form-select" id="sala" name = "sala">
                      <option></option>
                      <option value="1">Sala 1</option>
                      <option value="2">Sala 2</option>
                      <option value="3">Sala 3</option>
                      <option value="4">Sala 4</option>
                      <option value="5">Sala 5</option>
                    </select>
                </div>
              
            </div>
        </form>
    </div>


  <div class="btn-toolbar" role="toolbar">
    <div class="btn-group me-2" role="group">
      <button id="btnCadastrar" type="button" onClick="validarCamposFormulario()" class="btn btn-outline-primary btn-lg" alt="botaoCadastrar"> 
         Pesquisar </button>
    </div>
  
    <div class="btn-group me-2" role="group">
      <button type="submit" class="btn btn-outline-danger btn-lg" onClick="limparCampos()" alt="botaoLimpar">
        Limpar</button>       
    </div>
  
    <div class="btn-group me-2" role="group" >
      <button type="submit" class="btn btn-outline-success btn-lg" onClick="validarCamposFormularioValendo()" alt="botaoCadastrar"> Cadastrar</button>       
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
                            <tr>
                                <td> Agostinho Resende Semedo </td>
                                <td><button type="button" class="btn btn-outline-success" onClick="abrirModalInformarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-outline-success" onClick="abrirModalChamadaPaciente()"> Chamado </button></td>
                                <td id="colunaObservacao" >Paciente nao Chegou,botao Chegou HABILITADO,botao onClick="chamarPaciente()" Chamar DESABILTADO</td>
                              </tr>
                              <tr>
                                <td>Axel Landim Avelar </td>
                                <td><button type="button" class="btn btn-outline-danger" onClick="informarChegadaPaciente()"> Não Chegou</button></td>
                                <td><button type="button" class="btn btn-outline-danger" onClick="informarChegadaPaciente()"> Não Chamado</button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Kyle Serralheiro Brás</td>
                                <td><button type="button" class="btn btn-outline-success" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-outline-danger" onClick="chamarPaciente()">Não Chamado </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Adriana Nazário Semedo </td>
                                <td><button type="button" class="btn btn-outline-success" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-outline-success" onClick="chamarPaciente()">Chamado </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Samara Viana Abranches </td>
                                <td><button type="button" class="btn btn-outline-success" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-outline-success" onClick="chamarPaciente()">Chamado </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Kayden Guterres Maia </td>
                                <td><button type="button" class="btn btn-primary" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Sujana Lemes Bencatel </td>
                                <td><button type="button" class="btn btn-primary" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Eduard Curado Covinha </td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Stella Maia Vilariça </td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td>Elaine Ferreira Gonçalves</td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Thayra Bilhalva Morão </td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Edna Santana Cortês </td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Alexia Chousa Santarém </td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Wallace Rios Lima </td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Debora Sequeira Abranches </td>
                                <td><button type="button" class="btn btn-primary" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Rute Álvaro Festas </td>
                                <td><button type="button" class="btn btn-primary" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Cael Quintanilha Sarmento </td>
                                <td><button type="button" class="btn btn-primary" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>
                              <tr>
                                <td> Alvin Medina Sá </td>
                                <td><button type="button" class="btn btn-primary" onClick="informarChegadaPaciente()">Chegou</button></td>
                                <td><button type="button" class="btn btn-primary disabled" onClick="chamarPaciente()">Chamar </button></td>
                                <td id="colunaObservacao"></td>
                              </tr>

                              
                          
                        </tbody>
                    </table>
                </div>
            </div>




            



<!-- Modal de confirmação de CADASTRO-->
<div class="modal fade" id="modalConfirmacaoCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
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







<!-- MODAL TESTE DE CHAMADA DE CLIENTE --> 


<div class="modal fade" id="modalChamada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
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
        <button type="button" class="btn btn-primary">Confirmar</button>
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