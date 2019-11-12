@extends ('layout')

@section('titulodoNavegador')
   Editar Paciente
@endsection


@section('body')

<div id = "titulopagina">
       <h1> Editar Paciente </h1>                
</div>
<br>





@foreach($paciente as $pac)


    <div id="dados">
        <form name ="formulario" method = "post" action = '/pacientes/{{$pac->id}} '>
            @csrf
            <input type="hidden" name="_method" value="PUT">

        <label for="validationnomeCompleto"> Nome Completo </label>
            <input type="text" class="form-control"  id="nomeCompleto"  name = "nomeCompleto" value = "{{$pac->nome_completo}}" >  <br>

        <label for="validationdataNascimento"> Data de Nascimento </label>
            <input	type="date" class="form-control" placeholder=" Data" id="dataNascimento" name ="dataNascimento" value = "{{$pac->data_nascimento}}"  >

    <br>

        <label> Convênio do Paciente </label><br>
            @if( $pac->convenio_paciente == "Particular")
                <input type = "radio" name ="convenio" value = 'Particular' checked > Particular
                <input type = "radio" name ="convenio" value = 'Sus' > Sus 	<br>
            @else
                <input type = "radio" name ="convenio" value = 'Particular'> Particular
                <input type = "radio" name ="convenio" value = 'Sus'  checked > Sus 	<br>
            @endif



    <div id = 'segundaParte'>    
        <div class="row">
            <div class="col-md-18">

                <label> Dias da Semana </label>  <br>
                    @if( $pac->segunda_feira && $pac->quarta_feira && $pac->sexta_feira == "on")
                        <input type="checkbox" name ="segundaFeira" checked> Segunda Feira  <br>
                        <input type="checkbox" name ="tercaFeira"> Terça Feira           <br>
                        <input type="checkbox" name ="quartaFeira"checked> Quarta Feira   <br>
                        <input type="checkbox" name ="quintaFeira"> Quinta Feira          <br>
                        <input type="checkbox" name ="sextaFeira"checked> Sexta Feira    <br>
                        <input type="checkbox" name ="sabado" > Sábado                <br>
                    
                    @else
                        <input type="checkbox" name ="segundaFeira" > Segunda Feira          <br>
                        <input type="checkbox" name ="tercaFeira" checked> Terça Feira     <br>
                        <input type="checkbox" name ="quartaFeira" > Quarta Feira           <br>
                        <input type="checkbox" name ="quintaFeira" checked > Quinta Feira   <br>
                        <input type="checkbox" name ="sextaFeira" > Sexta Feira            <br>
                        <input type="checkbox" name ="sabado" checked> Sábado          <br>
                    
                    @endif
            <br>

                <label> Paciente é Soro Positivo? </label> <br>
                    @if( $pac->soro_positivo == 'SIM')  
                        <input type = "radio" name = "tpSanguineo" value ="SIM"  checked> SIM  
                        <input type = "radio" name ="tpSanguineo" value ="nao" > Não  <br>
                    @else
                        <input type = "radio" name = "tpSanguineo" value ="SIM"  > SIM 
                        <input type = "radio" name ="tpSanguineo" value ="nao" checked> Não  <br>
                    @endif

<br>

                <label>Status do Paciente </label> <br>
                    <select name="status">
                        <option value="Em Tratamento"  >Em Tratamento </option> 
                        <option value="Obito" >Obito</option>
                        <option value="Trânsito"> Trânsito</option>
                        <option value="Abandono"  >Abandono</option> 
                        <option value="Transferido" >Transferido</option>
                        <option value="Internado"> Internado</option>
                        <option value="Recuperou Função"> Recuperou Função</option>
                    </select>

<br><br>
            </div>
        </div>
    </div>


        <div id="botaoConcluir">
            <button type="submit"  class="btn btn-primary btn-lg" alt="botaoConcluir" >  Concluir </button>
        </div>           
    </form>


        <div id="botaoCancelar">
            <form action = "/paginainicial">
                <button type="submit" class="btn btn-info btn-lg" alt="botaoCancelar"> Cancelar	</button>
            </form>        
        </div>

</div>

@endforeach

@endsection

@section('extra_styles')

<style>

    #botaoCancelar{
        margin-top:-5rem;
        margin-left:15rem;
    }

    label{
        font-size:130%;
    }

    #nomeCompleto{
        height:5%;
        width:50%;
    }

    #dataNascimento{
        height:5%;
        width:16%;
    }

    #dados{
        margin-top:2%;
        margin-left:3%;
        font-size:15px;
    }

    #segundaParte{
        margin-top:-25rem;
        margin-left:70%;
    }

</style>

    @endsection