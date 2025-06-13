@extends ('layouts.layout')

<link href="{{ asset('/css/novoPainel.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/novoPainel.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

@section('tituloPagina', 'Painel')

@section('body')

<div id = "botaoTelaCheia">
  <form name="formulario" method = 'get' action = '/painel/{}'>
      <button class="btn btn-primary" type= "submit" >Tela Cheia </button>
  </form>                
</div>
<meta http-equiv="refresh" content=10 ; url="/painel">

<div class="col-lg-12">
  <div>
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

                @case(6)
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
@endsection

@section('extra_styles')

@endsection