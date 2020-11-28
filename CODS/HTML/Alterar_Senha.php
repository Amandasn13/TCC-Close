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
$sql = "CALL BuscarE_RecuperacaoR('$rash')";
$resultado = mysqli_query($connect, $sql);
$total = mysqli_affected_rows($connect);
if($total > 0){
$dados1 = mysqli_fetch_array($resultado);
mysqli_free_result($resultado);
mysqli_next_result($connect);
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Esqueci Minha Senha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuw
    vrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF
    5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="icon" type="imagem/png" href="IMG\Vetores\Close_Logo.png">
</head>
<style>
    body, html{
        height:100%;
        }
    .bg{
        background-image: linear-gradient(to left top, #ffbd00, #ffa20a, #ff871e, #ff6a2f, 
        #ff4b3e, #ff365c, #ff297b, #f72b99, #dc51c6, #b270e8, #7887fb, #0099ff); 
        background-repeat: no-repeat;
        background-size: cover; 
        height: 100%; 
        background-position: center;
    }
</style>
<body class="bg">
<br><br><br><br><br><br>
    <?php
        $email = $dados1['email'];
        $sql = "CALL BuscarId_UsuarioE('$email')";
        $resultado1 = mysqli_query($connect, $sql);
        $dados2 = mysqli_fetch_array($resultado1);
        mysqli_free_result($resultado1);
mysqli_next_result($connect); 
    ?>
    <center>
    <div class="jumbotron" style="width: 60%; background-color: #141414;">
        <H1 style="color: azure;">Digite sua nova senha e a confirmação!</H1><br>
        <form method="post">
            <input type="hidden" value="<?php echo $rash; ?>" name="rash">   
            <input type="hidden" value="<?php echo $dados2['IdUsuario'];?>" name="iduser">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning" id="inputGroup-sizing-default" style="height: 38px;">Senha</span>
                </div>
                <input type = "password" class="form-control" name ="novasenha" 
                placeholder="Digite a nova senha aqui!" required><br><br>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning" id="inputGroup-sizing-default" style="height: 38px;">Confirmação</span>
                </div>
                <input type = "password" class="form-control" name ="confirmanovasenha" 
            placeholder="Digite a confirmação de senha!" required><br><br>
            </div>
            <input type = "submit" class="btn btn-primary" name ="Confirmar" Value = "Alterar senha"><br>
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
    </div></center>        
</body>
</html>
<?php 
}else{
    header("location: Close_Log02.php");
    exit;
}
?>