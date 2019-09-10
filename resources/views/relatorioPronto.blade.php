<!--
@foreach($paciente as $pac)
    {{$pac->nome_completo}}<br>

@endforeach
-->

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
        <tr>        
          <th>  Nome Completo </th>
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          <th>6</th>
          <th>7</th>
          <th>8</th>
          <th>9</th>
          <th>10</th>
          <th>11</th>
          <th>12</th>
          <th>13</th>
          <th>14</th>
          <th>15</th>
          <th>16</th>
          <th>17</th>
          <th>18</th>
          <th>19</th>
          <th>20</th>
          <th>21</th>
          <th>22</th>
          <th>23</th>
          <th>24</th>
          <th>25</th>
          <th>26</th>
          <th>27</th>
          <th>28</th>
          <th>29</th>
          <th>30</th>
          <th>31</th>
          <th> Total de Extras</th>
          <th>Total de Faltas </th>
          <th>Total de Sessões</th>
        </tr>
<!--
        <tr>   
        @foreach($paciente as $pac)
          <td> {{$pac->nome_completo}} </td>
            @foreach($paciente as $pac)
              <td>{{ \Carbon\Carbon::parse($pac->created_at)->format('d/m/Y')}}  </td> 
              
            @endforeach 
        </tr>
          @endforeach
    </table>    
-->


        <tr>   
          @foreach($paciente as $pac)
            <td> {{$pac->nome_completo}} </td>
            @foreach($paciente as $pac)
              
                  <td>{{ \Carbon\Carbon::parse($pac->created_at)->format('d/m/Y')}}  </td> 
                @endforeach         
        </tr>
        @endforeach
    </table>    


  


          {{$totalSessoes}}
    
</body>
</html>
