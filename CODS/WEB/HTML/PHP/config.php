<?php
//aqui eu chamei os documentos necessários e iniciei a sessão  
require_once 'Conexao.php';
require_once 'Login_Cadastro.php';
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

<!--Como eu tinha copiado o codigo do arquivo Close_Estudio.php, os coisos do htm estão com Id's do css do ambos, perdão-->
<!DOCTYPE html>
<html lang = "pt-br">   
<head>
    <meta charset = "utf-8">
    <title>Configuração</title>
    
</head>  
<body>
<header><!--Cabeçalho-->
  <nav class="navbar navbar-default" role="navigation" id="rodp">
    <!--<h3 id="lgpr" class="nav navbar-nav">CLOSE</h3>-->
    <img src="../IMG\Icones\CLOSE.png" class="nav navbar-nav" id="lgpr">
    <ul>
       <li >
          <img role="button" type="submit" src="../IMG\Icones\unnamed.png" class="botao" height="30px" width="30px" >
       </li>
       <li >

            <a href="Sair.php" class="botao">Sair</a>
       </li>
    </ul>
  </nav>
</header>
<?php
//aqui tá pegando a foto do perfil da pessoa pra ela já ter uma visualização
    if($dados['Foto_Perfil']==""){
      echo '<img src="../IMG\Icones\8-512.png" id="uimg">';
    }else{
      echo'<img src="../Fotos_Perfis/'.$dados["Foto_Perfil"].'" id="uimg">';
    }
    
    
    
    ?>
<h3>Quer alterar sua foto do perfil?</h3><br>
<!--Aqui começa o formulário pra pessoa envia umma nova foto-->
<form method="post" action="cadastrarfoto.php" enctype="multipart/form-data">
	<!--Ali em baixo foram criados tres imputes, o primeiro é invisivel, nao tem necessidade de editar ele, o segundo é 
    o tipo file que é aonde a pessoa escolhr o arquivo, o ultimo é aonde a pesoa envia, o classico submit-->
    <input name="arquivo" type="file" placeholder="" id="arquivo" onchange="previewImagem()"><br><br>
    <img style="width: 150px; height: 150px;" id="img" name="img"><br><br>
    <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>"> 
	<input type="submit" value="Alterar foto"><br><br>
    
</form>
<!--Esse script existe pra pessoa conseguir visualizar a foto q ela vai por no perfil antes de upar ela, sabe?-->
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

<div class="col-4" id="cad">
        <!--Aqui começa o formulário pra pessoa mudar alguma coisa do perfil dela, nessa primeira parte, os dados pessoais-->
		<form method="post" name="edit1">
            <h3>Dados Pessoais</h3><br>
            <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>"> 
            <label id="leflab">Nome</label>  <label id="rigid">Sobrenome</label><br>
			<input type="text"  name="nome" maxlength="50" value="<?php Echo $dados['Nome']; ?>">
            <input type="text" maxlength="50" value="<?php Echo $dados['Sobrenome']; ?>" name="sbnome"><br><br>
            <label id="leflab">Nome de Usuário</label>  <label id="rigid">Data de nascimento</label><br>
			<input type="text" name="nusuario" value="<?php Echo $dados['Nome_Usuário']; ?>" maxlength="50">
            <input type="date" name="data" value="<?php Echo $dados['Data_Nascimento']; ?>"><br><br>
            <label id="leflab">Biografia</label><br>
            <input type="text" name="bio" value="<?php Echo $dados['Biografia']; ?>" maxlenght="150">
            <br><br><br>
            <input type="submit" name="Editar" value="Editar" class="botao" onclick="Mensagem()">
            <?php
                if(isset($_POST['nome']))
                {
                $id = addslashes($_POST['id_user']);
                $nome = addslashes($_POST['nome']);
                $sobrenome = addslashes($_POST['sbnome']); 
                $nomeusuario = addslashes($_POST['nusuario']);
                $nascimento = addslashes($_POST['data']); 
                $biografia = addslashes($_POST['bio']);
               

                    $u->conexao("login", "localhost","root","");
                    if($u->msgErro == "")
                    {
                        if($u->editar1($id, $nome, $sobrenome, $nomeusuario, $nascimento,
                        $biografia))
                        {
                            echo "<script language=javascript type= 'text/javascript'>
                            window.alert('Alterações concluidas com sucesso!')
                            </script>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";

                        }else{
                            echo "Não foi possivel editar!";

                        }
                    }else
                    {
                        echo "Erro: ".$u->msgErro;
                    }
                    }
            ?>      
			
	</form>
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
    <form method="post" name="edit3">
        <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>">
        <h3>Quer mudar seu E-mail?</h3><br> 
        <label>E-mail</label><br>
        <input type="email" name="Email" id="Email" value="<?php echo $dados['E_mail'] ?>" maxlength="100" required><br><br><br>          
        <input type="submit" name="editar2" value="Alterar E-mai">
        <?php 
        if(isset($_POST['Email']))
        {
            $id = addslashes($_POST['id_user']); 
            $email = addslashes($_POST['Email']);
            $u->conexao("login", "localhost","root","");
            if($u->msgErro == "")
            {
                if($u->verifica($email)){
                    if($u->editar3($email, $id)){
                        echo "<script language=javascript type= 'text/javascript'>
                        window.alert('E-mail alterado com sucesso!')
                        </script>";
                        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
                }  else{
                    echo "<script language=javascript type= 'text/javascript'>
                            window.alert('Falha em alterar e-mail!')
                            </script>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";       
            }

                }else{
                    echo "<script language=javascript type= 'text/javascript'>
                    window.alert('E-mail já está sendo utilizado por outro usuário!')
                    </script>";
                }

            }else{
                echo "Erro: ".$u->msgErro;
            }

        }
        
        
        
        ?>
    </form>                    
    
            
          
</div>            
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
