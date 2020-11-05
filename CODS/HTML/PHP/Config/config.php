<?php
//aqui eu chamei os documentos necessários e iniciei a sessão  
require_once '../Conexao.php';
require_once '../Login_Cadastro.php';
session_start();
if(!isset($_SESSION['IdUsuario']))
{
    header("location: ../Close_Log.php");
    exit;
}
 //logo aqui, criada uma forma de armazenar todos os dados do usuario em uma variavel.
$id = $_SESSION['IdUsuario'];
$sql = "SELECT * FROM Usuario WHERE IdUsuario = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
$u = new Usuario; 
?>

<!DOCTYPE html>
<html lang = "pt-br">   
<head>
    <meta charset = "utf-8">
    <title>Configuração</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'/>
    <link href="../CSS\Close_Cox.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery.js"></script>
</head>  
<body>
<header><!--Cabeçalho-->
  <nav class="navbar navbar-default" role="navigation" id="rodp">
    <!--<h3 id="lgpr" class="nav navbar-nav">CLOSE</h3>-->
    <img src="../../IMG\Icones\CLOSE.png" class="nav navbar-nav" id="lgpr">
    <ul>
       <li >
            <a href="Sair.php" class="botao">Sair</a>
       </li>
    </ul>
  </nav>
</header>
<div class="nvct">
<center><nav class="navbar navbar-dark bg-dark" style="width: 70%;">
    <a class="navbar-brand" href="#">Quer alterar sua foto de perfil?</a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarsExample01" style="">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
          <form class="px-4 py-3" method="post" action="../cadastrarfoto.php" enctype="multipart/form-data">
            <div class="form-group">
                <input name="arquivo" type="file" placeholder="" id="arquivo" class="form-control" onchange="previewImagem()"><br><br>
                <center><img id="edim" name="img"><br><br>
                <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>"class="form-control">
            </div>
            <input type="submit" class="btn btn-primary" value="Alterar foto"></center>
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script>
                function previewImagem() {
                    var imagem = document.querySelector ('input[name=arquivo]').files[0]; 
                    var preview = document.querySelector ('img[name=img]');

                    var reader = new FileReader ();

                    reader.onloadend = function () {
                        preview.src = reader.result;
                    }

                    if (imagem){
                        reader.readAsDataURL(imagem);
                    }else{
                        preview.src = "";
                    }
                }
            </script>
        </li>
    </ul>
</div>
  </nav></center>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <br><br>
  <!--Esse script existe pra pessoa conseguir visualizar a foto q ela vai por no perfil antes de upar ela, sabe?-->

<center><nav class="navbar navbar-dark bg-dark" style="width: 70%;">
    <a class="navbar-brand" href="#">Quer alterar seus dados pessoais?</a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarsExample01" style="">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
          <form class="px-4 py-3" method="post" name="edit1">
              <!--Aqui começa o formulário pra pessoa mudar alguma coisa do perfil dela, nessa primeira parte, os dados pessoais-->
            <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>"> 
            <div class="row"><br>
                <div class="col-md-6 mb-3">
                    <label id="leflab" style="color: aliceblue;">Nome</label><br>
                    <input type="text"  name="nome" class="form-control" maxlength="50" value="<?php Echo $dados['Nome']; ?>" placeholder="Nome">
                </div>  
                <div class="col-md-6 mb-3">
                    <label id="rigid" style="color: aliceblue;">Sobrenome</label><br>
                    <input type="text" maxlength="50"class="form-control" value="<?php Echo $dados['Sobrenome']; ?>" name="sbnome" placeholder="Sobrenome">
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label id="leflab" style="color: aliceblue;">Nome de Usuário</label><br>
                    <input type="text" name="nusuario" class="form-control" value="<?php Echo $dados['Nome_Usuário']; ?>" maxlength="50" placeholder="Nome de Usuário">
                </div>
                <div class="col-md-6 mb-3">
                    <label id="rigid" style="color: aliceblue;">Data de nascimento</label><br>
                    <input type="date" name="data" class="form-control" value="<?php Echo $dados['Data_Nascimento']; ?>" placeholder="DD/MM/AAAA">
                </div>
            </div>
            <br><br>
            <div class="col-md-6 mb-3">
                <label id="leflab" style="color: aliceblue;">Biografia</label><br>
                <input type="text" name="bio" class="form-control" value="<?php Echo $dados['Biografia']; ?>" maxlenght="150" placeholder="Biografia">
            </div>
            
            <br><br><br>
            <center><button type="submit" name="Editar" class="btn btn-primary" onclick="Mensagem()">Alterar dados</button></center>
            </form>
        </li>
       </ul> 
    </div>
  </nav></center>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <br><br>
    <!--Aqui começa um formulário pra pessoa que deseija mudar sua senha-->
    <!--<form method="post" name="edit2">
            <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>">
            <h3>Quer mudar sua senha?</h3><br>
            <label id="leflab">Senha</label>  <label id="rigid">Confirmação de senha</label><br>
            <input type="password" name="csenha" id="passC" placeholder="Digite sua nova senha!" maxlength="15" required>
            <input type="password" name="ccsenha" id="passCC" placeholder="Confirme sua nova senha!" maxlength="15" required><br><br><br> 
            <input type="submit" name="editar2" value="Alterar senha">
            <?php
                if(isset($_POST['csenha']))
                {
                $id = addslashes($_POST['id_user']);    
                $senha = addslashes($_POST['csenha']);
                $confirmarSenha = addslashes($_POST['ccsenha']);

                $u->conexao("login", "localhost","root","");
                if($senha == $confirmarSenha)
                {
                    if($u->msgErro == ""){
                        if($u->editar2($senha, $id)){
                            echo "<script language=javascript type= 'text/javascript'>
                            window.alert('Senha alterada com sucesso!')
                            </script>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
                    }  else{
                        echo "<script language=javascript type= 'text/javascript'>
                                window.alert('Falha em alterar senha!')
                                </script>";
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";       
                }
                }else{
                    echo "Erro: ".$u->msgErro;
                }
            }

                else
                {
                    echo "<script language=javascript type= 'text/javascript'>
                                window.alert('As senhas diferem!')
                                </script>";
                }
}
            ?>   
            
    </form> -->
<center><nav class="navbar navbar-dark bg-dark" style="width: 70%;">
    <a class="navbar-brand" href="#">Quer alterar seu email cadastrado?</a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarsExample01" style="">
      <ul class="navbar-nav mr-auto">
         <li class="nav-item active">
            <!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
            <form class="px-4 py-3" method="post" name="edit3">
                <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>">
                <label style="color: aliceblue;">E-mail</label><br>
                <input type="email" name="Email" id="Email" value="<?php echo $dados['E_mail'] ?>" placeholder="Email" maxlength="100" required><br><br><br>
                <center><button type="submit" name="editar2" class="btn btn-primary" onclick="Mensagem()">Alterar email</button></center>
            </form>
         </li>
        </ul> 
    </div>
</nav></center>         
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<br><br>
</div></center>
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