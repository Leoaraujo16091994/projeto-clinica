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