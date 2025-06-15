<link href="{{ asset('/css/novoPainelTelaCheia.css') }}" rel="stylesheet" type="text/css" >
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/novoPainelTelaCheia.js') }}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<title> Painel</title>

<meta http-equiv="refresh" content=10 ; url="/painel">

<div class="col-lg-12">
  <div class="tableFixHead">
      <table>
          @if($pacientesDoDia !== null ) 
          <tbody>
              @foreach($pacientesDoDia as $paciente)
              
              <tr>
                <td id="sala{{$paciente->sala_do_dia}}"> 
                @switch($paciente->sala_do_dia)
                  @case(1)
                    Sala A : {{$paciente->nome_completo}}</td>
                  @break

                  @case(2)
                    Sala B : {{$paciente->nome_completo}}</td>
                  @break

                  @case(3)
                    Sala C : {{$paciente->nome_completo}}</td>
                  @break

                  @case(4)
                    Sala D : {{$paciente->nome_completo}}</td>
                  @break

                  @case(5)
                    Sala E : {{$paciente->nome_completo}}</td>
                  @break

                  @case(7)
                    Sala F : {{$paciente->nome_completo}}</td>
                  @break

                @endswitch
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

