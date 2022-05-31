
@extends ('layout')


<link href="{{ asset('/css/novoPainel.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/novoPainel.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>



@section('titulodoNavegador', 'Cadastro de Paciente')

@section('body')

<div id = "tituloPagina">
       <h1> Painel </h1>                
</div>

<br>

<div id = "botaoTelaCheia">
  <form name="formulario" method = 'get' action = '/painel/{}'>
      <button class="btn btn-primary" type= "submit" >Tela Cheia </button>
  </form>                
</div>
<meta http-equiv="refresh" content=5 ; url="/painel">

<div class="col-lg-12">
                <div>
                    <table>
                        <tbody>
                            @foreach($pacientesDoDia as $paciente)
                            <tr>
                              <td id="sala{{$paciente->sala_do_dia}}"> Sala {{$paciente->sala_do_dia}} : {{$paciente->nome_completo}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                </div>
            </div>
@endsection

@section('extra_styles')

@endsection