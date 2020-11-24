
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Esqueci Minha Senha</title>
</head>
<body bgcolor = "#DC143C">
    <center><H1>Esqueceu a Senha?</H1>
    <H3>Basta Informar seu E-mail abaixo, para que possa alterar sua senha!</H3>
    <form method="post">
    <input type = "text" name ="Email"><br><br>
    <input type = "submit" name ="Enviar" Value = "Enviar"></center>
    <?php
    require_once 'PHP/Login_Cadastro.php';

    $u = new Usuario; 

                                    if(isset($_POST['Email']))
                                    {
                                        $email = addslashes($_POST['Email']);
                                                    
                                                

                                        $u->conexao("Tiffanny", "localhost","root","");
                                        if($u->msgErro == "")
                                        {
                                            if($u->verifica_dados($email))
                                            {
                                                echo "<script language=javascript type= 'text/javascript'>
                                                window.alert('E-mail existe.')
                                                </script>";
                                                
                                            }else{
                                                echo "<script language=javascript type= 'text/javascript'>
                                                window.alert('Email não existe.')
                                                </script>";

                                            }
                                        }else
                                        {
                                            echo "Erro: ".$u->msgErro;
                                        }
                                    }
                                ?>
                      </form>          
</body>
</html>
