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
        background-image: linear-gradient(to right bottom, #ffbd00, #ffa20a, #ff871e, #ff6a2f, 
        #ff4b3e, #ff365c, #ff297b, #f72b99, #dc51c6, #b270e8, #7887fb, #0099ff); 
        background-repeat: no-repeat;
        background-size: cover; 
        height: 100%; 
        background-position: center;
    }
</style>
<body class="bg">
<br><br><br><br><br><br>
<section style="heigh; 100%;">
<center>
<div class="jumbotron" style="width: 60%; background-color: #141414;">
    <h1 class="display-4" style="color: azure;">Esqueceu a Senha?</h1>
    <p class="lead" style="color: azure;">Basta Informar seu E-mail abaixo, para que possa alterar sua senha!</p>
    <form method="post" name="esquecisenha">
        <div class="input-group mb-3">
            <input type="email" name ="Email" class="form-control" placeholder="Digite seu email aqui" 
            aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-success" name="Enviar" type="submit" id="button-addon2"
                style="height: 38px; border-top-right-radius: 5px; border-bottom-right-radius: 5px;">Enviar</button>
                <?php
                    require_once 'PHP/Login_Cadastro.php';
                    $u = new Usuario; 
                    if(isset($_POST['Email']))
                    {
                        $email = addslashes($_POST['Email']);
                        $u->conexao("Tiffanny", "localhost","root","");
                        if($u->msgErro == "")
                        {
                            if($u->verificarash($email)){                            
                            $u->esquecisenha($email);
                            }else{
                                echo "<script language=javascript type= 'text/javascript'>
                                window.alert('Você já solicitou a redefinição de senha, cheque a caixa de entrada no seu e-mail! (Verifique nos spams).')
                                </script>";
                            }
                        }else
                        {
                            echo "Erro: ".$u->msgErro;
                        }
                    }
                ?>
            </form>    
            </div><br><br>
        </div>
</div>
</center>
</section>     
</body>
</html>
