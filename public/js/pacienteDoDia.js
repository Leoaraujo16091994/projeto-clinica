
var pacienteSelecionadoChegada ;
var pacienteSelecionadoChamada;


function buscarPaciente(){
    formulario = formulario;
    formulario.method = "get";
    formulario.action = "pacienteDoDia";
    formulario.submit();
 }

 //BOTAO LIMPAR CAMPOS
 function limparCampos(){
    var nome = document.getElementById("nomeCompleto");
    var diasDaSemana = document.getElementById("diasDaSemana");
    var turno = document.getElementById("turno");
    var sala = document.getElementById("sala"); 

    nome ? document.getElementById("nomeCompleto").value = "":null;
    diasDaSemana ? document.getElementById("diasDaSemana").value = "":null;
    turno ? document.getElementById("turno").value = "":null;
    sala ? document.getElementById("sala").value = "":null;
}



// MODALS
function abrirModalChamadaAcompanhante(paciente){
    this.pacienteSelecionadoChamada = paciente
    $('#modalChamadaAcompanhante').modal('show');
}
function abrirModalConfirmacaoCadastroPaciente (){
    $('#modalConfirmacaoCadastro').modal('show');
}

function abrirModalInformarChegadaPaciente (paciente){
    this.pacienteSelecionadoChegada = paciente;
    $('#modalChegada').modal('show');
}

function abrirModalChamadaPaciente (paciente){
    this.pacienteSelecionadoChamada = paciente
    $('#modalChamada').modal('show');
}

function abrirModalChamadaPacienteNovamente(paciente){
    this.pacienteSelecionadoChamada = paciente
    $('#modalChamadaNovamente').modal('show');
}



function abrirModalPacienteExtra (){
    var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '/todosPacientes',
            type: 'get',
            success: function (retorno) {
                $('#listaPacienteExtra').fadeIn();  
                $('#listaPacienteExtra').html(retorno);
        
            }, error: function () {
                console.log(erro, er);
            }
         });
    $('#modalPacienteExtra').modal('show');
}




//ALERTS
function alertDeErro(listaDeCamposInvalidos){
    console.log("chegou")
    document.getElementById('alert-erro').style.display = 'block';
    var lista  = [];
    for(const item of listaDeCamposInvalidos){
        lista =  lista + "<li>" + item +"</li>" ;
    };

    document.getElementById("lista").innerHTML = "Erro ao efetuar cadastro:" + lista;

    setTimeout(
        function(){
                document.getElementById('alert-erro').style.display = 'none'}, 5000);
}

function alertDeSucesso(){
    document.getElementById('alert-success').style.display = 'block';
    
    setTimeout(
        function(){
                document.getElementById('alert-success').style.display = 'none'}, 2000);
}




function confirmarCadastro(){
    alertDeSucesso();
    setTimeout(
        function(){
            document.formulario.submit();}, 1000);
    return true;
}




//FORMS
function informaChegadaPaciente(){
    document.getElementById("formularioChegada").setAttribute("action", "/pacienteDoDia/" + pacienteSelecionadoChegada.id);
    document.formularioChegada.submit();
}

function chamarPaciente(){
    document.getElementById("formularioChamada").setAttribute("action", "/pacienteDoDia/" + pacienteSelecionadoChamada.id);
    document.formularioChamada.submit();
}


function chamarPacienteNovamente(){
    document.getElementById("formularioChamada").setAttribute("action", "/chamarNovamente/" + pacienteSelecionadoChamada.id);
    document.formularioChamada.submit();
}

function chamarAcompanhante(){
    document.getElementById("formularioChamada").setAttribute("action", "/chamarAcompanhante/" + pacienteSelecionadoChamada.id);
    document.formularioChamada.submit();
}

function alterarPaciente(){
    document.formularioEdicao.submit();
}



//EVITAR O BOTAO ENTER
function EnterKeyFilter()
 {  
   if (window.event.keyCode == 13)
   {   
       event.returnValue=false;
       event.cancel = true;
   }
 }






 var idPacienteASerExcluido ;


 function abrirModalExcluirPacienteDoDia(idPaciente){
 
     idPacienteASerExcluido = idPaciente;
     $('#modalExcluirPacienteDoDia').modal('show');
 }
 
 
 function excluirPacienteDoDia(){
 
    alertExclusaoDeSucesso();
 
     setTimeout(
         function(){
             
             document.getElementById("idPacienteExcluido").value = idPacienteASerExcluido;
            
             formularioExclusao.setAttribute("action","");
             formularioExclusao.action = "pacienteDoDia/"+idPacienteASerExcluido ;
             formularioExclusao.submit();
         }, 1000);
 }
    
 function alertExclusaoDeSucesso(){
     document.getElementById('alert-exclusao-success').style.display = 'block';
     
     setTimeout(
         function(){
                 document.getElementById('alert-success').style.display = 'none'}, 2000);
 }
 

 


function adicionarPacienteExtra(){

    var listaDeCamposInvalidos = [];
    var nome = formularioPacienteExtra.paciente.value;
    var sala = formularioPacienteExtra.salaPacienteExtra.value;
    var turno = formularioPacienteExtra.turnoPacienteExtra.value;
   
    if(nome ==""){
         listaDeCamposInvalidos.push("É necessário selecionar um paciente");
    }

    if(sala ==""){
        listaDeCamposInvalidos.push("É necessário selecionar uma sala");
    }
    if(turno ==""){
        listaDeCamposInvalidos.push("É necessário selecionar um turno");
    }

    if(listaDeCamposInvalidos.length > 0){
        alertDeErro(listaDeCamposInvalidos);
         return 0;
     } else {
        alertDeSucesso();

        setTimeout(
            function(){
                document.formularioPacienteExtra.submit();;}, 1000);
        
     }
}

/*


$(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".dropdown-menu li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
*/



/*
MUITO IMPORTANTE
window.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('voice-form');
    const input = document.getElementById('speech');
    

    form.addEventListener('submit', event => {
      event.preventDefault();
      const toSay = input.value.trim();
      const utterance = new SpeechSynthesisUtterance(toSay);
      speechSynthesis.speak(utterance);
      input.value = '';
    });
  });
  */