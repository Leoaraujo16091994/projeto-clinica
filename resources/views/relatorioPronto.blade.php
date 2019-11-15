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

<?php   $totalExtra = 0    ?>
<?php   $totalFalta= 0   ?>
<?php   $totalSessoes = 0     ?>

<?php
    $date= Carbon\Carbon::parse($dataInicial)->format('m');
     $var = cal_days_in_month(CAL_GREGORIAN,$date,$ano);
 ?>


<table class="table table-bordered">
  <thead>
    <th>Nome</th>
        @for($i = 1 ; $i <= $var;$i++)
            <th>{{$i}}</th>
        @endfor

          <th> Total de Extras</th>
          <th>Total de Faltas </th>
          <th>Total de Sessões</th>
        </tr>

    </thead>
    <tbody>

    @foreach($pacientes as $paciente)
        @if( $paciente['sp'] == "SIM")
          <tr>
            <td>
              <font color="red">
                  {{$paciente['nome_paciente']}}  
              </font>                     
            </td>

          @for($i = 1 ,$x= 0 ,$f=0, $e = 0 ,$p = 0; $i <= $var;$i++)
                  @foreach($paciente['datas'] as $data)
                      @if( Carbon\Carbon::parse($data->created_at)->format('d') == $i )
                          <?php 
                              if($paciente['status'][$x]->status == 'F' ){
                                  $f++;
                            }  elseif ($paciente['status'][$x]->status == 'E') {
                                $e++;
                            }
                            elseif($paciente['status'][$x]->status == 'P')
                                $p++;
                            elseif($paciente['status'][$x]->status == 'T')
                                $p++;


                          ?>

                          <td>    {{  $paciente['status'][$x]->status }}  </td>     
                          <?php   $i++    ?>
                          <?php   $x++    ?>

                      @endif
                  @endforeach
                       
                @if($i <= $var)
                    <td>  </td>
                @endif
            @endfor

        <td> {{ $e }} </td>
        <td> {{ $f }} </td>
        <td> {{ $p }} </td>

        <?php   $totalExtra = $totalExtra + $e    ?>
        <?php   $totalFalta= $totalFalta + $f   ?>
        <?php   $totalSessoes = $totalSessoes + $p     ?>


    </tr>
            

    @else
                    
          <tr>
            <td>
              {{$paciente['nome_paciente']}}                   
            </td>

          @for($i = 1 ,$x= 0 ,$f=0, $e = 0 ,$p = 0; $i <= $var;$i++)
                  @foreach($paciente['datas'] as $data)
                      @if( Carbon\Carbon::parse($data->created_at)->format('d') == $i )
                          <?php 
                              if($paciente['status'][$x]->status == 'F' ){
                                  $f++;
                            }  elseif ($paciente['status'][$x]->status == 'E') {
                                $e++;
                            }
                            elseif($paciente['status'][$x]->status == 'P')
                                $p++;
                            elseif($paciente['status'][$x]->status == 'T')
                                $p++;
                          ?>

                          <td>    {{  $paciente['status'][$x]->status }}  </td>     
                          <?php   $i++    ?>
                          <?php   $x++    ?>

                      @endif
                  @endforeach
                       
                @if($i <= $var)
                    <td>  </td>
                @endif
            @endfor

        <td> {{ $e }} </td>
        <td> {{ $f }} </td>
        <td> {{ $p }} </td>

        <?php   $totalExtra = $totalExtra + $e    ?>
        <?php   $totalFalta= $totalFalta + $f   ?>
        <?php   $totalSessoes = $totalSessoes + $p     ?>


          </tr>
          @endif      

    @endforeach

    <tbody>
 </table>



 <table class="table table-bordered">
  <thead>
      <th> Total de Extras</th>
          <td> {{ $totalExtra }} </td>
      <th>Total de Faltas </th>
          <td> {{ $totalFalta }}</td>
      <th>Total de Sessões</th>
        <td> {{ $totalSessoes}}</td>

</thead>
</table>

    
</body>
</html>
