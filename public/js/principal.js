function validarCamposFormularioValendo(){
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



function abrirModalInformarChegadaPaciente (){
    $('#modalChamada').modal('show');
}


function abrirModalChamadaPaciente (){
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
                document.getElementById('alert-success').style.display = 'none'}, 3000);
}


function confirmarCadastro(){
    alertDeSucesso();
    setTimeout(
        function(){
            document.formulario.submit();}, 1000);
    return true;
}




function limparCampos(){
    document.getElementById("form").reset();
}


