<?php
    require_once 'PHP/Login_Cadastro.php';
    $u = new Usuario; 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/Close_Log2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	
    <link rel="icon" type="imagem/png" href="IMG\Vetores\Close_Logo.png">
    <style>
      @import url('CSS/Close_Log2.css');
    </style>
</head>
<body>
    <!--<script>
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    </script>-->
    <header>
        <br>
        <section>
            <center><form method="post" name="AP" style="border: 3px solid whitesmoke; width: 25%;">
                <center><legend> Login </legend><br>
                    <label for="l1">Usuário:</label><br>
                    <input type="text" id="l1" name="usuário" placeholder="Digite o nome de usuário ou e-mail" required ><br><br>
                    <label for="l2">Senha:</label><br>
                    <input type="password" id="l2" style="width: 280px;" name="senha" placeholder="Digite sua senha" required><br><br><!-- lembra da vizualização da senha-->
                    <input type="submit" value="Entrar" class="botao" onclick="MostrarNome()">
                    <br><br><a href id="fgs">Esqueci minha senha</a><br><br>
                    <a href="#hpnv" id="fgs">Desejo me cadastrar</a><br><br></center>
            </form></center><br>
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
                                    
                                    header("location: Close_Estudio2.php");
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
            <style>
                            .wave-1 {
                    animation: moveWave1 2s ease-in-out infinite alternate;
                }

                @keyframes moveWave1 {
                    from {
                    transform: translateX(27px);
                    }
                }
                .wave-2 {
                    animation: moveWave2 3s 1.2s ease-in-out infinite alternate;
                }

                @keyframes moveWave2 {
                    from {
                    transform: translateX(400px);
                    }
                }

                .wave-3 {
                    animation: moveWave3 3s 0.7s ease-in-out infinite alternate;
                }

                @keyframes moveWave3 {
                    from {
                    transform: translateY(60px);
                    }
                }
                .wave-4 {
                    animation: moveWave4 3s 1.2s ease-in-out infinite alternate;
                }

                @keyframes moveWave4 {
                    from {
                    transform: translateX(200px);
                    }
                }

                .wave-5 {
                    animation: moveWave5 3s 0.7s ease-in-out infinite alternate;
                }

                @keyframes moveWave5 {
                    from {
                    transform: translateY(10px);
                    }
                }
            </style>       
        <svg xmlns="http://www.w3.org/2000/svg" class="ondas" viewBox="0 0 1440 320">
                <path class= "wave wave-1" fill="#FFBD00" fill-opacity="1"
                    d="M0,96L34.3,112C68.6,128,137,160,206,149.3C274.3,139,343,85,411,90.7C480,96,549,160,617,165.3C685.7,171,754,117,823,112C891.4,107,960,149,1029,154.7C1097.1,160,1166,128,1234,112C1302.9,96,1371,96,1406,96L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"
                ></path>
                <path class= "wave wave-2" fill="#FF5400" fill-opacity="1"
                    d="M0,256L15,218.7C30,181,60,107,90,106.7C120,107,150,181,180,192C210,203,240,149,270,149.3C300,149,330,203,360,218.7C390,235,420,213,450,170.7C480,128,510,64,540,37.3C570,11,600,21,630,32C660,43,690,53,720,85.3C750,117,780,171,810,176C840,181,870,139,900,133.3C930,128,960,160,990,186.7C1020,213,1050,235,1080,229.3C1110,224,1140,192,1170,192C1200,192,1230,224,1260,229.3C1290,235,1320,213,1350,218.7C1380,224,1410,256,1425,272L1440,288L1440,320L1425,320C1410,320,1380,320,1350,320C1320,320,1290,320,1260,320C1230,320,1200,320,1170,320C1140,320,1110,320,1080,320C1050,320,1020,320,990,320C960,320,930,320,900,320C870,320,840,320,810,320C780,320,750,320,720,320C690,320,660,320,630,320C600,320,570,320,540,320C510,320,480,320,450,320C420,320,390,320,360,320C330,320,300,320,270,320C240,320,210,320,180,320C150,320,120,320,90,320C60,320,30,320,15,320L0,320Z"
                ></path>
                <path class= "wave wave-3" fill="#FF0054" fill-opacity="1" 
                    d="M0,192L21.8,170.7C43.6,149,87,107,131,80C174.5,53,218,43,262,37.3C305.5,32,349,32,393,69.3C436.4,107,480,181,524,213.3C567.3,245,611,235,655,213.3C698.2,192,742,160,785,154.7C829.1,149,873,171,916,149.3C960,128,1004,64,1047,85.3C1090.9,107,1135,213,1178,229.3C1221.8,245,1265,171,1309,144C1352.7,117,1396,139,1418,149.3L1440,160L1440,320L1418.2,320C1396.4,320,1353,320,1309,320C1265.5,320,1222,320,1178,320C1134.5,320,1091,320,1047,320C1003.6,320,960,320,916,320C872.7,320,829,320,785,320C741.8,320,698,320,655,320C610.9,320,567,320,524,320C480,320,436,320,393,320C349.1,320,305,320,262,320C218.2,320,175,320,131,320C87.3,320,44,320,22,320L0,320Z"
                ></path>
                <path class= "wave wave-4" fill="#9E0059" fill-opacity="1" 
                    d="M0,224L15,213.3C30,203,60,181,90,186.7C120,192,150,224,180,229.3C210,235,240,213,270,218.7C300,224,330,256,360,266.7C390,277,420,267,450,224C480,181,510,107,540,101.3C570,96,600,160,630,176C660,192,690,160,720,160C750,160,780,192,810,213.3C840,235,870,245,900,224C930,203,960,149,990,144C1020,139,1050,181,1080,213.3C1110,245,1140,267,1170,250.7C1200,235,1230,181,1260,165.3C1290,149,1320,171,1350,197.3C1380,224,1410,256,1425,272L1440,288L1440,320L1425,320C1410,320,1380,320,1350,320C1320,320,1290,320,1260,320C1230,320,1200,320,1170,320C1140,320,1110,320,1080,320C1050,320,1020,320,990,320C960,320,930,320,900,320C870,320,840,320,810,320C780,320,750,320,720,320C690,320,660,320,630,320C600,320,570,320,540,320C510,320,480,320,450,320C420,320,390,320,360,320C330,320,300,320,270,320C240,320,210,320,180,320C150,320,120,320,90,320C60,320,30,320,15,320L0,320Z"
                ></path>
                <path class= "wave wave-5" fill="#0099ff" fill-opacity="1"
                    d="M0,32L15,69.3C30,107,60,181,90,202.7C120,224,150,192,180,176C210,160,240,160,270,154.7C300,149,330,139,360,144C390,149,420,171,450,197.3C480,224,510,256,540,261.3C570,267,600,245,630,245.3C660,245,690,267,720,261.3C750,256,780,224,810,218.7C840,213,870,235,900,256C930,277,960,299,990,261.3C1020,224,1050,128,1080,90.7C1110,53,1140,75,1170,117.3C1200,160,1230,224,1260,245.3C1290,267,1320,245,1350,224C1380,203,1410,181,1425,170.7L1440,160L1440,320L1425,320C1410,320,1380,320,1350,320C1320,320,1290,320,1260,320C1230,320,1200,320,1170,320C1140,320,1110,320,1080,320C1050,320,1020,320,990,320C960,320,930,320,900,320C870,320,840,320,810,320C780,320,750,320,720,320C690,320,660,320,630,320C600,320,570,320,540,320C510,320,480,320,450,320C420,320,390,320,360,320C330,320,300,320,270,320C240,320,210,320,180,320C150,320,120,320,90,320C60,320,30,320,15,320L0,320Z"
                ></path>
            </svg>
        </header>
</section>
<section style="background-color: #0099ff; color: whitesmoke; bottom:0%;">
<center>
<div class="mx-auto">
    <form method="post" name="Cad" class="nvc" style="margin-right: 145px;"><br>
        <legend id="hpnv" style="margin-left: 50px;"> Novo por aqui? </legend><br>
        <h3 style="width: 98%; margin-left: 65px;">Faça seu cadastro agora, é rápido  fácil!</h3><br>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-4">
                    <input type="text" style="width: 365px;" id="all-in" name="nome" placeholder="Digite o seu nome" maxlength="50" required><br><br>
                    <input type="text" style="width: 365px;" name="sbnome"  id="all-in"placeholder="Digite seu sobrenome" maxlength="50"required><br><br>
                </div>
                <div class="col-4">
                    <input type="text" style="width: 365px;" name="nusuario" id="all-in" placeholder="Digite seu nome de usuário" maxlength="50" required><br><br>
                    <input type="date" style="width: 365px;" name="data" id="all-in" placeholder="DD/MM/AAAA" required><br><br>
                </div>
            </div><br>
            <div class="row justify-content-around">
                <div class=col-4>
                    <input type="email" name="Email" id="all-in" placeholder="Digite seu email" class="em" style="width: 365px;" maxlength="100" required><br><br>
                    <input type="password" name="csenha" id="passC" style="width: 365px;" placeholder="Digite sua senha" maxlength="100" required><br><br>
                </div><br>
                <div class="col-4">
                    <input type="password" name="ccsenha" id="passC" style="width: 365px;" placeholder="Confirme sua senha" maxlength="100" required><br><br>
                    <input type="submit" name="cadastro" value="Cadastrar" style="width: 365px;" class="botao" onclick="Mensagem()"></center>
                </div>
            </div>
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
                                    if($u->verifica($email)){
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
        </div><br><br>
        <br><br>    
    </form>
</div>
</center>
<footer>
        <nav class="navbar navbar-default" role="navigation" id="rodp">
        <center>
          <ul>
            <li>
                <a href="Close_SbrNs.html">SOBRE NÓS E CONTATO</a>
            </li>
        </ul>
      </center>
    </nav>
    </footer>
</section>
</body>
</html>
