<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title> @yield('tituloNavegador')</title>

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="chamar.css" />

    <link
            href="https://fonts.googleapis.com/css?family=Allerta|Archivo+Black|Domine|Great+Vibes|Italianno|Lobster|Lora|Mitr|Parisienne|Pathway+Gothic+One|Pinyon+Script|Playball|Sigmar+One|Ultra|Viga"
            rel="stylesheet">


            <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Anton|Francois+One|Lobster|Patua+One|Playfair+Display&display=swap" rel="stylesheet">
</head>

<body>


<div class="bordaSuperior">
    <div id="nomeInicial"> Clinica Prontorim </div>

</div>

<div id = "botaoSair">
  <a class ="btn btn-danger" alt="botaoSair"><h4> Sair</h4> </a>
</div>





<nav class = "bordaEsquerda">
    <ul>
        <a href="Usuário"> <li> Usuária </li></a>
        <a href="painel.html"> <li> Painel </li> </a>
        <a href="chamar.html"> <li> Chamar </li> </a>
        <a href="relatorios"> <li> Relatórios </li> </a>
    </ul>
</nav>


<div id="tituloDaTela"> @yield('tituloDaTela') </div>


@yield('conteudo')



<style>

    .bordaSuperior {
        padding: 1.0%;
        background-color: #0174DF;
        color: #FFFFFF;
        font-size: 250%;
        border-bottom: 0.1px solid black;
    }

    #botaoSair a {
        border-radius: 10px;
        width: 5%;
        height: 7%;
        margin-left: 92%;
        margin-top: -4.7%;
    }

    #botaoSair h4{
       margin-top:15%;
    } 

    .bordaEsquerda {
        background-color: #FFFFFF;
        width: 17%;
        height:88%;
        border-right: 3px solid #BDBDBD;
    }

    .bordaEsquerda ul {
        list-style: none; /*Retira as bolinhas */
        padding-left: 0px;
    }

    .bordaEsquerda li {
        border-bottom: 0.1px solid black;
        padding: 7px;
        font-size: 18px;
        background-color: #0174DF;
    }

    .bordaEsquerda a { /*	DEIXA A LETRA BRANCA E TIRA O TRAÇO EMBAIXO*/
        color: white;
        text-decoration: none;
    }

    .bordaEsquerda li:hover { /*  EFEITO QUANDO O USUÁRIO PASSAR O MOUSE*/
        background-color: #0431B4;
        transition: 0.8s;
    }


    #tituloDaTela{
      margin-top:-42%;
       margin-left:18%;
       font-size: 280%;
       border-bottom: 1px solid black;



    }


</style>

</body>
</html>