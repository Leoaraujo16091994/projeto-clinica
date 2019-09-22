<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title> @yield('titulodoNavegador')</title>

    <!-- Bootstrap -->
    <link href="/layout/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>





<table class="table table-bordered">
  <thead>
    <th>Nome</th>
    @for($i = 1 ; $i <= cal_days_in_month(CAL_GREGORIAN,$mes,$ano);$i++)
      <th>{{$i}}</th>
    @endfor

    <th> Total de Extras</th>
          <th>Total de Faltas </th>
          <th>Total de Sessões</th>
        </tr>

    </thead>
    
    <tbody>

      
    @foreach($pacientes as $paciente)
          <tr>
            <td>
              {{$paciente['nome_paciente']}}
            </td>
            

              @for($i = 1 ; $i <= cal_days_in_month(CAL_GREGORIAN,$mes,$ano);$i++)
                  @foreach($paciente['datas'] as $data)
                      
                      @if( Carbon\Carbon::parse($data->created_at)->format('d') == $i )
                          <td> P </td>
                        <?php   $i++    ?>
                      @endif
                  @endforeach
                    <td>  </td>
              @endfor

              <td>  </td>
              <td>  </td>
              <td> {{ count($paciente['datas'])}} </td>
            
         
         
         
         
         
         
         
         
         
         
         
          </tr>
          @endforeach

    <tbody>
 </table>



    <tbody>
 </table>
  

    
</body>
</html>
