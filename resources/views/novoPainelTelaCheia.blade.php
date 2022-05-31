



<link href="{{ asset('/css/novoPainelTelaCheia.css') }}" rel="stylesheet" type="text/css" >
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/novoPainelTelaCheia.js') }}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


<title> Painel</title>


<meta http-equiv="refresh" content=5 ; url="/painel">

<div class="col-lg-12">
                <div class="tableFixHead">
                    <table>
                        @if($pacientesDoDia !== null ) 
                        <tbody>
                            @foreach($pacientesDoDia as $paciente)
                           
                            <tr>
                              <td id="sala{{$paciente->sala_do_dia}}"> Sala {{$paciente->sala_do_dia}} : {{$paciente->nome_completo}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                          @endif
                    </table>
                </div>
            </div>
        

@if($ultimoPacienteChamado)
<header>
      <h1>Browser voices</h1>
    </header>
    <main>
      <form class="input" id="voice-form">
        <div class="field">Nome</label>
        @if($ultimoPacienteChamado)
          <input type="text" value="{{$ultimoPacienteChamado[0]->nome_completo}}"name="speech" id="speech" required />
        </div>
        @endif
        <button >FALAR</button>
      </form>
    </main>
@endif

<div id = "botaoTelaCheia">
  <form method = 'get' action = '/painel'>
      <button class="btn btn-primary" type= "submit" >Voltar </button>
  </form>                
</div>

