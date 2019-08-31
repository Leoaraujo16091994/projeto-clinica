@extends ('template')

@section('tituloNavegador', 'Cadastro de Funcionarios')

@section('conteudo')


    <div id="dadosFuncionario">
        <form method='post'>
            @csrf

            <br><br>
            <label> Nome Completo </label>
            <input type="text" class=" form-control " placeholder="Nome Completo" id= "nomeCompleto"  name = "nomeCompleto">
            <br>

          <label>Login </label>
          <input type="text" class="form-control" placeholder="Login" id="login"  name = "id">
 
            <br>

            <label> Senha </label>
            <input type="password" class=" form-control " placeholder=" Senha" id="senha" name ="senha">

            <br>



            <label> Cargo </label>
            <select name="cargo">
                <option> Administração</option>
                <option > Recepção</option>
            </select>
            
            <br><br><br>
            
            

        <button class="btn btn-primary" alt="botaoCadastrar ">  Cadastrar </button>
        <button class="btn btn-info" alt="botaoCancelar">	Cancelar	</button>

            <br><br>

        </form>
    </div>
@endsection

@section('extra_styles')
    <style>
        #dadosFuncionario{
            margin-left:20%;
            height:5%;
            width:40%;
        }

        #login{
            width:50%;
        }
        
        #senha {          
            width:30%;
        }
    </style>
@endsection
