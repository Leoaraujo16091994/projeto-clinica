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
    <!-- Font Awesome -->
    <link href="/layout/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/layout/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/layout/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="/layout/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/layout/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/layout/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/layout/build/css/custom.min.css" rel="stylesheet">
    @yield('extra_styles')
  </head>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-home"></i> <span> Grupo Pronefron</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
   <!--
            <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
-->
                            

              <div class="profile_info">
                <span>Bem Vindo,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
    
    
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Geral</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Paciente <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/pacientes/create">Novo Paciente</a></li>
                      <li><a href="/chegada/create">Informar Chegada </a></li>
                      <li><a href="/pacientes">Consultar Paciente </a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Painel <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/chamarpainel/create"> Chamar Paciente </a></li>
                      <li><a href="/painel"> Painel </a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Relatorios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/relatorios/create">Relatorio  </a></li>
                     
                    </ul>
                  </li>
                </ul>
              </div>
            
            </div>
         
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
              @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                      </li>
                            @endif


                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <!--  <li><a href="javascript:;"> Perfil </a></li>
                    <li>
                      <a href="javascript:;">
                        <span> Configurações </span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Ajuda</a></li>     -->
                     
                  <li><a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('') }}<i class="fa fa-sign-out pull-right"></i> Sair </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">    
                        @csrf
                    </form>
                  </li>
                     
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    
                  </a>
                 
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        
          </div>
          <br />

         
		 
		 
		 
		<div class="right_col" role="main">
            <div class="">
                <div class="row top_tiles">
                 
                <div class="animated flipInY col-lg-10 col-md-3 col-sm-6 col-xs-12">
                        @yield('body')
                    </div>
                </div>
            </div>
        </div>  

	
  </body>
</html>

 <!-- jQuery -->
    <script src="/layout/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/layout/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/layout/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/layout/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/layout/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/layout/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/layout/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/layout/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/layout/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/layout/vendors/Flot/jquery.flot.js"></script>
    <script src="/layout/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/layout/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/layout/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/layout/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/layout/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/layout/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/layout/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/layout/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/layout/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/layout/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/layout/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/layout/vendors/moment/min/moment.min.js"></script>
    <script src="/layout/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/layout/build/js/custom.min.js"></script>



<style>
  #titulopagina{
    font-size:20px;
  }
  </style>