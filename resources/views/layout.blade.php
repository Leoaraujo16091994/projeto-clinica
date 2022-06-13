<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compble" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title> @yield('titulodoNavegador')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link href="/layout/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/layout/build/css/custom.min.css" rel="stylesheet">
   @yield('extra_styles')
  </head>


  <body class="nav-md">
    <div class="container body" style="max-width: 100%">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="principal" class="site_title"><i class="fa fa-home"></i> <span> Clínica Prontorim</span></a>
            </div>

            <!-- NOME DO USUARIO LADO ESQUERDO -->
            <!--<div class="profile clearfix">
              <div class="profile_info">
                <span>Bem Vindo,</span>
                <h2>@yield('usuarioLogado')</h2>
              </div>
            </div> -->
    
            <br />

            <!-- MENUS DO LADO ESQUERDO -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <!--  <h3>Geral</h3>-->
                <ul class="nav side-menu">
                  
                 <li><a><i class="fa fa-edit"></i> Paciente <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/paciente">Pacientes</a></li>
                 <!--      <li><a href="/chegada/create">Informar Chegada </a></li>
                      <li><a href="/pacientes">Consultar Paciente </a></li>
                    -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Painel <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
   <!--                   <li><a href="/chamarpainel/create"> Chamar Paciente </a></li>-->
                      <li><a href="/painel"> Painel </a></li>
                    </ul>
                  </li>
                  <!--
                  <li><a><i class="fa fa-table"></i> Relatorios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/relatorios/create">Relatorio  </a></li>
                    </ul>
                  </li>
-->
                </ul>
              </div>
            </div>


          </div>
        </div>
        
        <!-- BOTOES CADASTRAR E SAIR  -->
        <div class="top_nav">
          <div class="nav_menu">
            <ul class="nav" style="float:right;">
              <!--<li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('') }}<i class="fa fa-sign-out pull-right"></i> Sair 
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">    
                  @csrf
                </form>
              </li>
            </ul>
           </div>
        </div>
      
      <br />

      <div class="right_col" role="main">
            <div class="">
                @yield('body')
            </div>
        </div>  
   </body>
</html>

 <!-- jQuery -->
    <script src="/layout/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/layout/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts-->
    <script src="/layout/build/js/custom.min.js"></script> 



<style>
  #titulopagina{
    font-size:20px;
  }
  
  .nav {
    display:  inline-flex;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
  }

 
  li {
    position:relative;
    width:15rem;
  }

  .top_nav .navbar-right {
    margin: 0;
    width: 20%;
    float: right;
  }

  .menu {
    display:inline;
  }

  .nav .nav-item{
    text-align: right;
    width:3cm;
  }

</style>

