<?php
require_once 'PHP/Conexao.php';
require_once 'PHP/Login_Cadastro.php';
if(!isset($_GET['chave']))
{
    header("location: Close_Log02.php");
    exit;
}
$rash = $_GET['chave'];
$u = new Usuario;
$sql = "SELECT email FROM recover_solicitation WHERE rash = '$rash'";
$resultado = mysqli_query($connect, $sql);
$dados1 = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Esqueci Minha Senha</title>
</head>
<body bgcolor = "#DC143C">
    <?php
        $email = $dados1['email'];
        $sql = "SELECT IdUsuario FROM Usuario WHERE E_mail = '$email'";
        $resultado1 = mysqli_query($connect, $sql);
        $dados2 = mysqli_fetch_array($resultado1); 
    ?>
    <center><H1>Digite sua nova senha e a confirmação!</H1>
    <form method="post">
    <input type="hidden" value="<?php echo $rash; ?>" name="rash">   
    <input type="hidden" value="<?php echo $dados2['IdUsuario'];?>" name="iduser">
    <input type = "password" name ="novasenha" placeholder="Digite a nova senha aqui!" required><br><br>
    <input type = "password" name ="confirmanovasenha" placeholder="Digite a confirmação de senha!" required><br><br>
    <input type = "submit" name ="Confirmar" Value = "Alterar senha"></center>
    <?php

                                    if(isset($_POST['novasenha']))
                                    {
                                        $rash =  addslashes($_POST['rash']);
                                        $id = addslashes($_POST['iduser']);
                                        $senha = addslashes ($_POST['novasenha']);
                                        $confirmasenha = addslashes($_POST['confirmanovasenha']);
                                                
                                        if($senha == $confirmasenha){
                                        $u->conexao("Tiffanny", "localhost","root","");
                                        if($u->msgErro == "")
                                        {
                                            
                                            if($u->editar2($senha, $id) && $u->deletarash($rash)){
                                                echo "<script language=javascript type= 'text/javascript'>
                                                window.alert('Senha alterada!');
                                                window.location.href = 'Close_Log02.php'
                                                </script>";
                                                
                                            }else{
                                                echo "<script language=javascript type= 'text/javascript'>
                                    window.alert('Não foi possível alterar a senha!')
                                    </script>";
                                            }
                                    
                                        }else
                                        {
                                            echo "Erro: ".$u->msgErro;
                                        }
                                    }
                                else{
                                    echo "<script language=javascript type= 'text/javascript'>
                                    window.alert('As senhas diferem!')
                                    </script>";
                                }
                            }
                                ?>
    </form>          
</body>
</html>