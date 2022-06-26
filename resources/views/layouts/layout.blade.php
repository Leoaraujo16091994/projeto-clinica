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

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
 <!--
              <div class="profile_info">
                <span>Bem Vindo,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
-->
            </div>
    
 
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> Paciente <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="/paciente">Pacientes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Painel <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="/painel"> Painel </a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
        
            
            <!-- /menu footer buttons -->
          </div>
        </div>




        <!-- BOTOES CADASTRAR E SAIR  -->
        <div class="top_nav">
          <div class="nav_menu">
               <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
            <ul class="nav" style="float:right;">
            <!-- <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('') }}<i class="fa fa-sign-out pull-right"></i> Sair </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">    
                        @csrf
                    </form>
                  </li> -->
                  <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
          <li><a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                         Sair </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">    
                        @csrf
                    </form>
                  </li>
            
          </ul>
        </li>
            </ul>
           </div>
        </div>


        
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
    display:  inline;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
  }
  .navbar {
    margin-bottom: 10;
}

.profile_info {
  padding:0;
    width: 100%;
    float: left;
}

.dropdown-menu > li > a:hover {
    background-image: none;
    background-color: #73879C;
    color:white;
}

.top_nav .dropdown-menu li a {
    float: right;
    width: 50%;
}
    /*

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
*/
</style>

