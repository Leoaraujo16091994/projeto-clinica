function validarCamposFormulario(){
    var listaDeCamposInvalidos = [];
    var nome = formulario.nomeCompleto.value;
    var dataNascimento = formulario.dataNascimento.value;
    var status = formulario.status.value;
    var tpSangue = formulario.tpSanguineo.value;
    var convenio = formulario.convenio.value;
    
    var dias = document.getElementsByClassName('diasDaSemana');
    
    var diasSQS = dias.segundaFeira.checked || dias.quartaFeira.checked || dias.sextaFeira.checked
    var diasTQS = dias.tercaFeira.checked || dias.quintaFeira.checked || dias.sabado.checked

    //Todos os dias selecionados ou os dias estaos errados  
    if(diasSQS && diasTQS ){
        listaDeCamposInvalidos.push("Os dias selecionados estão errados,devem ser SEG,QUA e SEX ou TER,QUI e SAB");
    }

    //Não selecionando nenhum dia
    if(!dias.segundaFeira.checked && !dias.quartaFeira.checked && !dias.sextaFeira.checked
        &&            
        !dias.tercaFeira.checked && !dias.quintaFeira.checked && !dias.sabado.checked){
            listaDeCamposInvalidos.push("É obrigatorio selecionar os dias da semana");
    }


    if(nome ==""){
         listaDeCamposInvalidos.push("Nome Completo é obrigatório");
    }
    
    if(dataNascimento == ""){
            listaDeCamposInvalidos.push("Data de Nascimento é obrigatório");
    }
    
    if(status == "") {
            listaDeCamposInvalidos.push("Status é obrigatório");
    }
    
    if(convenio == "") {
            listaDeCamposInvalidos.push("Convênio é obrigatório");
    }
    
    if(tpSangue == "") {
            listaDeCamposInvalidos.push("Tipo Sanguíneo é obrigatório");
    }
    if(listaDeCamposInvalidos.length > 0){
       alertDeErro(listaDeCamposInvalidos);
        return 0;
    } else {
            abrirModal();
    }
}


function abrirModal (){
    $('#modalConfirmacaoCadastro').modal('show');
}



function alertDeErro(listaDeCamposInvalidos){
    document.getElementById('alert-erro').style.display = 'block';
    var lista  = [];
    for(const item of listaDeCamposInvalidos){
        lista =  lista + "<li>" + item +"</li>" ;
    };

    document.getElementById("lista").innerHTML = "Erro:" + lista;

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
            document.formulario.submit();}, 3000);
    return true;
}
