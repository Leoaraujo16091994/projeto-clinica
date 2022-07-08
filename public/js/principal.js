
var pacienteSelecionadoChegada ;
var pacienteSelecionadoChamada;

function buscarPaciente(){
    formulario = formulario;
    formulario.method = "get";
    formulario.action = "principal";
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
    document.getElementById("formularioChegada").setAttribute("action", "/principal/" + pacienteSelecionadoChegada.id);
    document.formularioChegada.submit();
}

function chamarPaciente(){
    document.getElementById("formularioChamada").setAttribute("action", "/principal/" + pacienteSelecionadoChamada.id);
    document.formularioChamada.submit();
}


function chamarPacienteNovamente(){
    document.getElementById("formularioChamada").setAttribute("action", "/chamarNovamente/" + pacienteSelecionadoChamada.paciente_pk);
    document.formularioChamada.submit();
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

/*
function validarCamposFormularioCadastrar(){
    var listaDeCamposInvalidos = [];
    var nome = formulario.nomeCompleto.value;
    var diasDaSemana = formulario.diasDaSemana.value;
    var turno = formulario.turno.value;
    var sala = formulario.sala.value;
   
    if(nome ==""){
         listaDeCamposInvalidos.push("O campo Nome Completo é obrigatório");
    }

    if(diasDaSemana ==""){
        listaDeCamposInvalidos.push("O campo Dias da Semana é obrigatório");
    }

    if(turno ==""){
    listaDeCamposInvalidos.push("O campo  Turno é obrigatório");
    }

    if(sala ==""){
        listaDeCamposInvalidos.push("O campo  Sala é obrigatório");
    }

    if(listaDeCamposInvalidos.length > 0){
       alertDeErro(listaDeCamposInvalidos);
        return 0;
    } else {
        abrirModalConfirmacaoCadastroPaciente();
    }
}
*/

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