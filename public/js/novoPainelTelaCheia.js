/*function alertDeErro(listaDeCamposInvalidos){
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

*/
$( document ).ready(function() {
    const input = document.getElementById('speech')? document.getElementById('speech'): null;
    
    if(input != null) {
    const toSay = input.value.trim();
    const utterance = new SpeechSynthesisUtterance(toSay);
    speechSynthesis.speak(utterance);
    input.value = '';
}
});
/*
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
  });*/