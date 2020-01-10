<!DOCTYPE html>
<html>

<head>

    <title> Painel - Clinica Prontorim </title>


    <link rel="stylesheet" type="text/css" media="screend and(min-width: 1000px)" href="large.css" />

    <meta http-equiv="refresh" content=5 ; url="/painel">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link
        href="https://fonts.googleapis.com/css?family=Allerta|Archivo+Black|Domine|Great+Vibes|Italianno|Lobster|Lora|Mitr|Parisienne|Pathway+Gothic+One|Pinyon+Script|Playball|Sigmar+One|Ultra|Viga"
        rel="stylesheet">


    <link
        href="https://fonts.googleapis.com/css?family=Abril+Fatface|Anton|Francois+One|Lobster|Patua+One|Playfair+Display&display=swap"
        rel="stylesheet">

<style>

    .bordaSuperior {
        position: fixed;
        height: 15%;
        top:0;
        left: 0;
        width: 100%;
        background-color: #0174DF;
    }

    .bordaSuperior #nomeInicial {
        position: absolute;
        left: 0;
        color: #FFF;
        font-size: 42px;
        height: 100%;
        width: 80%;
        padding: 20px;
    }

    .bordaSuperior #botaoTelaNormal {
        position: absolute;
        right: 0;
        width: 20%;
        height: 100%;
        text-align: center;
    }

    .bordaSuperior #botaoTelaNormal button {
        margin: 10%;
    }

    .tabela {
        position: absolute;
        top: 15%;
        left: 0;
        width: 100%;
        height: 85%;
        border-color: #000;
        border-spacing: 0px;
        text-align:center;
    }

    .tabela .painel {
        background-color: #FFFFFF;
    }

    .tabela .painel td {
        padding: 6px;
    }
    
    td{
        border:2px solid black;
    }
    
    table h1 {
        font-size:450%;
    }

    table h2 {
        font-size: 350%;
    }

    table h3 {
        color: black;
    }

    tr td {
        font-family: 'Anton', sans-serif;
        color: #0000FF;
    }

    .painel h1{
        color:blue;
        -webkit-animation-name:example;
        -webkit-animation-duration:0.3s;
        animation-name:example;
        animation-duration:0.3s;
    }

    @keyframes example{
        from{ color:blue; }
        to{color:red }    
        }


    </style>
</head>


<body>

    <div class="bordaSuperior">
        <span id="nomeInicial"> Clinica Prontorim </span>

        <div id="botaoTelaNormal">
            <form action="/painel">
                <button class="btn btn-primary" type="submit"> Voltar </button>
            </form>
        </div>
    </div>





    @if($qtdPacientes == 0 )
            <table border = "5px">
                <tr>            
                        <td rowspan="3">
                            <h3>Paciente: </h3>
                                {{'Sem pacientes cadastrados'}}
                        </td>    
                    </tr>
                    </table>

        @elseif ($qtdPacientes == 1 ) 
                <table class="tabela">
                <tr>
                    <td rowspan="3" class="painel atualChamado">
                        <h3>Paciente: </h3>
                        <h1> {{$paciente[0]->nome_completo}} </h1>
                        <h3>Sala:</h3>
                        <h1> {{$paciente[0]->sala}} </h1>
                    </td>
                </tr>

                <tr>
                    <td class="painel ultimoChamado">
                        <h3>Paciente: </h3>
                        <h2> {{"Vazio"}} </h2>
                        <h3>Sala:</h3>
                        <h2> {{"Vazio"}} </h2>
                    </td>
                </tr>


                <tr>
                    <td class="painel ultimoChamado">
                        <h3>Paciente: </h3>
                        <h2> {{"Vazio"}} </h2>
                        <h3>Sala:</h3>
                        <h2> {{"Vazio"}} </h2>
                    </td>
                </tr>


            </table>

             
       
        @elseif ($qtdPacientes == 2 )
            <table class="tabela">
                <tr>
                    <td rowspan="3" class="painel atualChamado">
                        <h3>Paciente: </h3>
                        <h1> {{$paciente[0]->nome_completo}} </h1>
                        <h3>Sala:</h3>
                        <h1> {{$paciente[0]->sala}} </h1>
                    </td>
                </tr>

                <tr>
                    <td class="painel ultimoChamado">
                        <h3>Paciente: </h3>
                        <h2> {{$paciente[1]->nome_completo}} </h2>
                        <h3>Sala:</h3>
                        <h2> {{$paciente[1]->sala}} </h2>
                    </td>
                </tr>


                <tr>
                    <td class="painel ultimoChamado">
                        <h3>Paciente: </h3>
                        <h2> {{"Vazio"}} </h2>
                        <h3>Sala:</h3>
                        <h2> {{"Vazio"}} </h2>
                    </td>
                </tr>


            </table>


        @else 

    <table class="tabela">
        <tr>
            <td rowspan="3" class="painel atualChamado">
                <h3>Paciente: </h3>
                <h1> {{$paciente[0]->nome_completo}} </h1>
                <h3>Sala:</h3>
                <h1> {{$paciente[0]->sala}} </h1>
            </td>
        </tr>

        <tr>
            <td class="painel ultimoChamado">
                <h3>Paciente: </h3>
                <h2> {{$paciente[1]->nome_completo}} </h2>
                <h3>Sala:</h3>
                <h2> {{$paciente[1]->sala}} </h2>
            </td>
        </tr>


        <tr>
            <td class="painel ultimoChamado">
                <h3>Paciente: </h3>
                <h2> {{$paciente[2]->nome_completo}} </h2>
                <h3>Sala:</h3>
                <h2> {{$paciente[2]->sala}} </h2>
            </td>
        </tr>


    </table>
    @endif
</body>

</html>