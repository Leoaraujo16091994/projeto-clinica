

function buscarPaciente(){
    formulario = formulario;
    formulario.method = "get";
    formulario.action = "paciente";
    formulario.submit();
 }


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



function abrirModalConfirmacaoCadastroPaciente (){
    $('#modalConfirmacaoCadastro').modal('show');
}



function alertDeErro(listaDeCamposInvalidos){
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


function limparCampos(){
    document.getElementById("nomeCompleto").value = "";
    document.getElementById("diasDaSemana").value = "";
    document.getElementById("turno").value = "";
    document.getElementById("sala").value = "";
}


var idPacienteASerExcluido ;


function abrirModalExcluirPaciente(idPaciente){

    idPacienteASerExcluido = idPaciente;
    $('#modalExcluirPaciente').modal('show');
}


function excluirPaciente(){

   alertExclusaoDeSucesso();

    setTimeout(
        function(){
            formularioExclusao.appendChild(document.getElementById("nomeCompleto")) ;
            formularioExclusao.appendChild(document.getElementById("diasDaSemana")) ;
            formularioExclusao.appendChild(document.getElementById("turno")) ;
            formularioExclusao.appendChild(document.getElementById("sala")) ;
            document.getElementById("idPacienteExcluido").value = idPacienteASerExcluido;
           
            formularioExclusao.setAttribute("action","");
            formularioExclusao.action = "paciente/"+idPacienteASerExcluido ;
            formularioExclusao.submit();
        }, 1000);
}
   
function alertExclusaoDeSucesso(){
    document.getElementById('alert-exclusao-success').style.display = 'block';
    
    setTimeout(
        function(){
                document.getElementById('alert-success').style.display = 'none'}, 2000);
}

function limparUrl(){
    formularioExclusao.action = "";
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
