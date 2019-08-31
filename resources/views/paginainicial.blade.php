
@extends ('layout')

@section('titulodoNavegador')
     Pagina Inicial
@endsection


@section('body')


<div id = "botoes">
<!--
<form method='get' action= 'pacientes/create'>
    <button class="btn btn-primary" alt="botaoNovoPaciente "    >  <h4> Novo Paciente </h4></button>
</form>

 <form method='get' action= '/chegada/create'>
    <button class="btn btn-primary" alt="botaoInfoChegada">	<h4>Informar Chegada	</h4></button>
 </form>

    

 <form method='get' action= '/consultarpaciente'>
    <button class="btn btn-primary" alt="botaoConsultarPaciente " onclick="msg()" >  <h4> Consultar Paciente </h4></button>
 </form>
-->


<button type ="button"class="btn btn-primary" onclick="window.location='{{route("pacientes.create") }}'">  <h4> Novo Paciente </h4></button>

<button type ="button"class="btn btn-primary" onclick="window.location='{{route("chegada.create") }}'">  <h4> Informar Chegada </h4></button>

<button type ="button"class="btn btn-primary" onclick="window.location='{{route("pacientes.index") }}'">  <h4>  Consultar Paciente  </h4></button>




</div>
   
@endsection

<style>
    
button{
    padding-left:90px;
}

</style>
