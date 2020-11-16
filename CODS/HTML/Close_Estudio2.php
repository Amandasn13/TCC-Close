<?php
require_once 'PHP/Conexao.php';
require_once 'PHP/Login_Cadastro.php';
session_start();
if(!isset($_SESSION['IdUsuario']))
{
    header("location: Close_Log.php");
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
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Estúdio</title>
    <!--Abaixo: conexão com as folhas de estilo de bootstrap e de css pessoal/nosso-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="CSS\Close_Est2.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="icon" type="imagem/png" href="IMG\Vetores\Close_Logo.png">
</head>
<body id="pg"> 
<header><!--Cabeçalho com links-->
  <nav role="navigation" id="rodp">
    <img src="IMG\Vetores\Close_EscLog.png" class="nav navbar-nav" id="lgpr" width="80px" height="30px">
    <ul>
      <li>
        <button type="button" value="Editar Perfil" class="btn btn-outline-warning" data-toggle="modal" data-target="#ModalEditPf">Editar Perfil</button>
        <!--Modal de Edição-->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEditPf">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgb(17, 14, 14);"><br>
                <ul class="nav nav-tabs row" role="tablist" id="navo">
                  <li role="presentation" class="col-6 col-md-4 active">
                    <a href="#EdFt" role="tab" data-toggle="tab" id="nvl">Alterar Foto</a>
                  </li>
                  <li role="presentation" class="col-6 col-md-4">
                    <a href="#EdDd" data-toggle="tab" role="button" id="navo" >Alterar Dados</a>
                  </li>
                  <li role="presentation" class="col-6 col-md-4">
                    <a href="#EdEm" role="tab" data-toggle="tab" id="navo">Alterar Email</a>
                  </li>
                </ul><br><br>
              <!--Divs de Conteúdo de cada Aba de navegação-->
              <div class="container-fluid">
                <div class="tab-content">
                <!--Editar foto-->
                  <div id="EdFt" role="tabpanel" class="tab-pane fade in active">
                    <div>
                      <center><h2 style="color: ivory;">Alterar a foto de perfil</h2><br>
                      <form class="px-4 py-3" method="post" action="PHP/cadastrarfoto.php" enctype="multipart/form-data">
                        <div class="form-group">
                          <input name="arquivo" type="file" placeholder="" id="arquivo" class="form-control" onchange="previewImagem()"><br><br>
                          <center><img id="uimg" name="img" class="ov1"></center><br><br>
                          <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>"class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Alterar foto</button>
                      </form>
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
                    </div>
                  </div>
                  <!--Editar dados-->
                  <div id="EdDd" role="tabpanel" class="tab-pane fade">
                    <div>
                      <center><h2 style="color: ivory;">Alterar os dados pessoais</h2><br>
                      <form class="px-4 py-3" method="post" name="edit1">
                        <!--Aqui começa o formulário pra pessoa mudar alguma coisa do perfil dela, nessa primeira parte, os dados pessoais-->
                        <div class="row"><br>
                          <div class="col-md-6 mb-3">
                          <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>"> 
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
                            <input type="text" name="nusuario" class="form-control" value="<?php Echo $dados['Nome_de_Usuario']; ?>" maxlength="50" placeholder="Nome de Usuário">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label id="rigid" style="color: aliceblue;">Data de nascimento</label><br>
                            <input type="date" name="data" class="form-control" value="<?php Echo $dados['Data_de_Nascimento']; ?>" placeholder="DD/MM/AAAA">
                          </div>
                        </div>
                        <br><br><br>
                        <center><button type="submit" name="Editar" class="btn btn-primary">Alterar dados</button></center>
                        <?php
                if(isset($_POST['nome']))
                {
                $id = addslashes($_POST['id_user']);
                $nome = addslashes($_POST['nome']);
                $sobrenome = addslashes($_POST['sbnome']); 
                $nomeusuario = addslashes($_POST['nusuario']);
                $nascimento = addslashes($_POST['data']); 
               

                    $u->conexao("Tiffanny", "localhost","root","");
                    if($u->msgErro == "")
                    {
                        if($u->editar1($id, $nome, $sobrenome, $nomeusuario, $nascimento
                        ))
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
                      </form></center>
                    </div>
                  </div>
                  <!--Editar email-->
                  <div id="EdEm" role="tabpanel" class="tab-pane fade">
                    <div>
                      <center><h2 style="color: ivory;">Alterar o email cadastrado</h2><br>
                      <form class="px-4 py-3" method="post" name="edit3">
                        <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>">
                        <label style="color: aliceblue;">E-mail</label><br>
                        <input type="email" name="Email" id="Email" value="<?php echo $dados['E_mail'] ?>" placeholder="Email" maxlength="100" required><br><br><br>
                        <button type="submit" name="editar2" class="btn btn-primary">Alterar email</button>
                        <?php 
        if(isset($_POST['Email']))
        {
            $id = addslashes($_POST['id_user']); 
            $email = addslashes($_POST['Email']);
            $u->conexao("Tiffanny", "localhost","root","");
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
                      </form></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>     
      </li>
      <a href="Close_GuardRp.php">
      <li>
        <input type="button" value="Guarda-Roupa" class="btn btn-outline-primary">
      </li>
      </a>
      <li>
        <input type="button" value="Desapegos" class="btn btn-outline-success">
      </li>
      <a href="PHP/Sair.php">
       <li >
<input type="button" href="PHP/Sair.php" value="Sair" class="btn btn-outline-dark">         
       </li>
       </a> 
    </ul>
  </nav>
</header>
<div class="container">
  <div class="row justify-content-start">
    <!--<div style="width: 30px;"></div>-->
    <div id="grid" class="col-4 align-self-center">
      <!--Foto do usuário-->
    <center><?php
        if($dados['Foto_de_Perfil']==""){
        echo '<img src="IMG\Icones\8-512.png" id="uimg" class="ov1">';
        }else{
        echo'<img src="Fotos_Perfis/'.$dados["Foto_de_Perfil"].'" id="uimg" class="ov1">';
        }
    ?></center>
      <!--toggles-->
      <div class="ov2">
        <div style="height: inherit; width: inherit;" id="el3" class="row align-items-center">
          <center><h6 class="col">Deseja mudar o modo de tela?</h6></center>
          <div class="container cow">
            <ul class="row align-items-center" style="list-style-type: none; padding-left: -5px;"> 
              <li class="col" >
              <div class="custom-control custom-switch">
                <input type="checkbox" role="button" class="custom-control-input" style="height: 10px;" id="tg1">
                <label class="custom-control-label" for="tg1"></label>
              </div>
              </li>
              <li class="col">
              <div class="custom-control custom-switch ">
                <input type="checkbox" role="button" class="custom-control-input" style="height: 10px;" id="tg2">
                <label class="custom-control-label" for="tg2"></label>
              </div>
              </li>
              <li class="col">
              <div class="custom-control custom-switch">
                <input type="checkbox" role="button" class="custom-control-input" style="height: 10px;" id="tg3">
                <label class="custom-control-label" for="tg3"></label>
              </div>
              </li> 
              <script>
                document.getElementById("tg1").onclick = function() {
                myFunction()
                };

                function myFunction() {
                  let color = document.body.style.background;
                  if (color === 'black','#131324') {
                    document.body.style.background = "#fcfcff";
                  }else{
                    document.body.style.background = "#f7f9fc";
                  }
                }

                document.getElementById("tg2").onclick = function() {
                myFunction2()
                };

                function myFunction2() {
                  let color = document.body.style.background;
                  if (color === 'black','#fcfcff') {
                    document.body.style.background = "#131324";
                    document.body.style.color = "#FFFFF";
                  }else{
                    document.body.style.background = "#f7f9fc";
                  }
                }

                document.getElementById("tg3").onclick = function() {
                myFunction3()
                };

                function myFunction3() {
                  let color = document.body.style.background;
                  if (color === '#fcfcff','#131324') {
                    document.body.style.background = "black";
                    document.body.style.color = "#FFFFF";
                  }else{
                    document.body.style.background = "#f7f9fc";
                  }
                }

                document.querySelectorAll('input[type=checkbox]').forEach(element => element.addEventListener('click', disableOther))

                function disableOther(event) {
                  if (event.target.checked) {

                    document.querySelectorAll('input[type=checkbox]').forEach(element => element.disabled = true)
                    
                    event.target.disabled = false;

                  } else {

                    document.querySelectorAll('input[type=checkbox]').forEach(element => element.disabled = false)

                  }
                }
              </script>
            </ul>
            <ul class="row align-items-center" style="list-style-type: none;">
              <li class="col">
                <p>Claro</p>
              </li>
              <li class="col">
                <p>Meio-termo</p>
              </li>
              <li class="col">
                <p>Escuro</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Dados do usuário-->
    <div class="ov3">
      <div class="col-4" id="infus">
        <h1 name="socnm"><?php Echo $dados['Nome']; ?></h1>
        <h3 name="unm">@<?php Echo $dados['Nome_de_Usuario']; ?></h3>
        <h3 name="unm"><?php Echo date("d/m/Y",strtotime($dados['Data_de_Nascimento'])); ?></h3>
      </div>
    </div>
  </div>
</div>
<!--Tempo e Dicas-->
<div class="wdr">
    <a class="weatherwidget-io" href="https://forecast7.com/pt/n23d53n46d79/osasco/" data-label_1="OSASCO" data-label_2="Atualizações do tempo" data-font="Roboto Slab" data-icons="Climacons Animated" data-theme="weather_one" >OSASCO Atualizações do tempo</a>
    <script>
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
    </script>
</div>
<br>
<hr style="height: 2px; background-color: rgb(201, 198, 198); width: 90%; opacity: 30%;"><br>
<div class="container">
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="card flex-md-row mb-4 shadow-sm h-md-250">
        <div class="card-body d-flex flex-column align-items-start" style="background-image: linear-gradient(to right bottom, #ffbd00, #ffab00, #ff9900, #ff8600, 
        #ff7200, #ff640e, #ff5518, #ff4421, #ff3730, #ff2a3d, #ff1948, #ff0054); color: honeydew;">
          <div class="lkcd">
            <strong class="d-inline-block mb-2 text-danger">Moda</strong>
            <h3 class="mb-0">
              <a class="text-light" href="Close_GuardRp.php">//Colocar aqui uma frase associada ao tempo</a>
            </h3>
            <p class="card-text mb-auto">Confira agora as roupas e looks que você tem salvos para esse climinha</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="flex-md-row mb-4 shadow-sm h-md-250">
        <div class="card-body d-flex flex-column align-items-start" style="background-image: linear-gradient(to right bottom, #ff0054, #ee0058, #dc005a, #ca005b, 
        #b7005b, #b2166c, #ab267c, #a1338b, #984faf, #8369d0, #6082eb, #0099ff); color: honeydew;">
          <div id="lkcd2">
            <strong class="d-inline-block mb-2 text-primary">Desapegos</strong>
            <h3 class="mb-0">
              <a class="text-light" href="#">Algo no fundo do guarda-roupa que não usa mais?</a>
            </h3>
            <p class="card-text mb-auto">Veja instituições e organizações que podem ser a resposta ideial pro seu desapego</p>
          </div>
        </div>
      </div>
    </div>
  </div>
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