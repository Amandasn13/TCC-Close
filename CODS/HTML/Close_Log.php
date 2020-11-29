<?php
    require_once 'PHP/Login_Cadastro.php';
    $u = new Usuario; 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS\Close_Log.css">
	<link rel="icon" type="imagem/png" href="IMG\Vetores\Close_Logo.png">
</head>
<body>
    <!--primeira div de corpo, div de acesso pessoal-->
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-4 row">
                    <img src="IMG\Vetores\Close_DbLog01 (1).png" alt="Logo do projeto Close" width="280px" height="225px"  style="padding-top:2%; padding-left:85px;">
                    <div class="col" id="log">
                        <form method="post" name="AP">
                        <center><legend> Login </legend><br>
                            <label for="l1">Usuário:</label><br>
                            <input type="text" id="l1" name="usuário" placeholder="Digite o nome de usuário ou e-mail" required ><br><br>
                            <label for="l2">Senha:</label><br>
                            <input type="password" id="l2" style="width: 280px;" name="senha" placeholder="Digite sua senha" required><br><br><!-- lembra da vizualização da senha-->
                            <input type="submit" value="Entrar" class="botao" onclick="MostrarNome()">
                        </form><br>
                        <?php
                        if(isset($_POST['usuário']))
                        {

                            $nomeusuario = addslashes ($_POST['usuário']);
                            $senha = addslashes ($_POST['senha']);
                            $email = addslashes ($_POST['usuário']);
                            //if(!empty($nomeusuario) && !empty($senha))
                            //{
                                $u->conexao("Tiffanny", "localhost","root","");
                                if($u->msgErro == ""){
                                if($u->logar($nomeusuario, $senha, $email))
                                {
                                    
                                    header("location: Close_Estudio.php");
                                }else
                                {
                                    echo "<script language=javascript type= 'text/javascript'>
                                    window.alert('Email e/ou senha incorretos, ou usuário não cadastrado!')
                                    </script>";
                                }
                                }else
                                {
                                    echo "Erro: ".$u->msgErro;
                                }
                            //}
                            //else
                            //{
                            //  echo"Preencha todos os campos!";
                            //}
                        }
                        ?>
                    <a href>Esqueci minha senha</a></center>
                    <br><br>
            </div>
        </div>
	<!-- segunda div do corpo, formulário de cadastro-->
	<div class="col-4" id="cad">
		<form method="post" name="Cad"><br>
            <legend> Novo por aqui? </legend><br>
            <h3 style="width: 98%;">Faça seu cadastro agora, é rápido  fácil!</h3><br>
            <!--<label id="leflab" class="col-4">Nome</label>  <label id="rigid" class="col-4">Sobrenome</label><br><br>-->
			<center><input type="text" id="all-in" name="nome" placeholder="Digite o seu nome" maxlength="50" required>
            <input type="text" name="sbnome"  id="all-in"placeholder="Digite seu sobrenome" maxlength="50"required><br><br>
            <!--<label id="leflab" class="col-4">Nome de Usuário</label>  <label id="rigid" class="col-4">Data de nascimento</label><br><br>-->
			<input type="text" name="nusuario" id="all-in" placeholder="Digite seu nome de usuário" maxlength="50" required>
            <input type="date" name="data" id="all-in" placeholder="DD/MM/AAAA" required><br><br>
            <!--<label id="leflab">Email</label><br><br>-->
            <input type="email" name="Email" id="all-in" placeholder="Digite seu email" class="em" style="width: 365px;" maxlength="100" required><br><br>
            <!--<label id="leflab" class="col-4">Senha</label>  <label id="rigid" class="col-4">Confirmação de senha</label><br><br>-->
            <input type="password" name="csenha" id="passC" style="width: 345px;" placeholder="Digite sua senha" maxlength="100" required><br><br>
            <input type="password" name="ccsenha" id="passC" style="width: 345px;" placeholder="Confirme sua senha" maxlength="100" required></center>
            <br><br>
            <input type="submit" name="cadastro" value="Cadastrar" class="botao" onclick="Mensagem()">
            <!--Verifica se a pessoa clicou no botao-->
            <?php
                if(isset($_POST['nome']))
                {
                $nome = addslashes($_POST['nome']);
                $sobrenome = addslashes($_POST['sbnome']); 
                $nomeusuario = addslashes($_POST['nusuario']);
                $nascimento = addslashes($_POST['data']); 
                $email = addslashes($_POST['Email']);
                $senha = addslashes($_POST['csenha']);
                $confirmarSenha = addslashes($_POST['ccsenha']);

                //<!--VERIFICA SE NAO DEIXOU NADA VAZIO-->
                //if(!empty($nome) && !empty($sobrenome) && !empty($nomeusuario) 
                //&& !empty($nascimento) && !empty($email) && !empty($senha) 
                //&& !empty($confirmarSenha))
                //{
                    $u->conexao("Tiffanny", "localhost","root","");
                    if($u->msgErro == "")
                    {
                        if($senha == $confirmarSenha)
                        {
                            if($u->verificarEmail($email)){
                        if($u->cadastrar($nome, $sobrenome, $nomeusuario, $nascimento,
                        $email, $senha, $confirmarSenha))
                        {
                            echo "<script language=javascript type= 'text/javascript'>
                            window.alert('Cadastrado!')
                            </script>";
                        }
                        else
                        {
                            echo "<script language=javascript type= 'text/javascript'>
                            window.alert('Usuario já cadastrado!')
                            </script>";
                        }
                    }else{
                        echo "<script language=javascript type= 'text/javascript'>
                        window.alert('Esse e-mail já está sendo usado por outro usuário')
                        </script>";
                    }
                        }      
                        else{
                            echo "<script language=javascript type= 'text/javascript'>
                            window.alert('As senhas diferem!')
                            </script>";
                        } 
                    }
                    else
                    {
                        echo "Erro: ".$u->msgErro;    
                    }
                //}
                //else
                //{
                    //echo "Preencha todos os campos";
                //}
                
                }
            ?>      
			
	</form>
		
    </div></div></div>
    <footer>
        <nav class="navbar navbar-default" role="navigation" id="rodp">
        <center>
          <ul>
            <li>
                <a href="">SOBRE</a>
            </li>
            <li>
                <a href="">AJUDA</a>
            </li>
            <li>
                <a href="">NÓS</a>
            </li>
            <li>
                <a href="">CONTATO</a>
            </li>
        </ul>
      </center>
    </nav>
    </footer>
</body>
</html>
